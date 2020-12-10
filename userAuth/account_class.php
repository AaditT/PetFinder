<!--
Aadit Trivedi
Web Apps, Period 2

Amazing tutorial: https://alexwebdevelop.com/user-authentication/

-->

<?php

# This is the account class that helps user management
# such as logging in and signing up
class Account
{
	# instance variables
	private $id;
	private $name;
	private $authenticated;

	# Account constructor
	public function __construct()
	{
		$this->id = NULL;
		$this->name = NULL;
		$this->pwd = NULL;
		$this->authenticated = FALSE;
	}
	public function __destruct() {}

		# returns account ID
		public function getId(): ?int
		{
			return $this->id;
		}

		# returns account name
		public function getName(): ?string
		{
			return $this->name;
		}

		# returns whether account is authenticated
		public function isAuthenticated(): bool
		{
			return $this->authenticated;
		}

		# Creates a new account
		public function addAccount(string $name, string $passwd): int
		{
			global $pdo;
			$name = trim($name);
			$passwd = trim($passwd);
			if (!$this->isNameValid($name))
			{
				throw new Exception('Invalid user name');
			}
			if (!$this->isPasswdValid($passwd))
			{
				throw new Exception('Invalid password');
			}
			if (!is_null($this->getIdFromName($name)))
			{
				throw new Exception('Username already exists');
			}
			$query = 'INSERT INTO pet_find.accounts (account_name, account_passwd) VALUES (:name, :passwd)';
			$hash = password_hash($passwd, PASSWORD_DEFAULT);
			$values = array(':name' => $name, ':passwd' => $hash);
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
			return $pdo->lastInsertId();
		}

		# This method deletes an account
		public function deleteAccount(int $id)
		{
			global $pdo;
			if (!$this->isIdValid($id))
			{
				throw new Exception('Invalid account ID');
			}

			# Deleting account from SQL database
			$query = 'DELETE FROM pet_find.accounts WHERE (account_id = :id)';
			$values = array(':id' => $id);
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
			$query = 'DELETE FROM pet_find.account_sessions WHERE (account_id = :id)';
			$values = array(':id' => $id);
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
		}

		# This method edits the account - not used in my app
		public function editAccount(int $id, string $name, string $passwd, bool $enabled)
		{
			global $pdo;
			$name = trim($name);
			$passwd = trim($passwd);
			if (!$this->isIdValid($id))
			{
				throw new Exception('Invalid account ID');
			}
			if (!$this->isNameValid($name))
			{
				throw new Exception('Invalid user name');
			}
			if (!$this->isPasswdValid($passwd))
			{
				throw new Exception('Invalid password');
			}
			$idFromName = $this->getIdFromName($name);
			if (!is_null($idFromName) && ($idFromName != $id))
			{
				throw new Exception('User name already used');
			}
			$query = 'UPDATE pet_find.accounts SET account_name = :name, account_passwd = :passwd, account_enabled = :enabled WHERE account_id = :id';
			$hash = password_hash($passwd, PASSWORD_DEFAULT);
			$intEnabled = $enabled ? 1 : 0;
			$values = array(':name' => $name, ':passwd' => $hash, ':enabled' => $intEnabled, ':id' => $id);
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
		}

		# This method logs an account in
		public function login(string $name, string $passwd): bool
		{
			global $pdo;
			$name = trim($name);
			$passwd = trim($passwd);
			if (!$this->isNameValid($name))
			{
				return FALSE;
			}
			if (!$this->isPasswdValid($passwd))
			{
				return FALSE;
			}

			# Saving the login into the SQL Database
			$query = 'SELECT * FROM pet_find.accounts WHERE (account_name = :name) AND (account_enabled = 1)';
			$values = array(':name' => $name);
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
			$row = $res->fetch(PDO::FETCH_ASSOC);
			if (is_array($row))
			{
				if (password_verify($passwd, $row['account_passwd']))
				{
					$this->id = intval($row['account_id'], 10);
					$this->name = $name;
					$this->authenticated = TRUE;
					$this->registerLoginSession();
					return TRUE;
				}
			}
			return FALSE;
		}

		# Validates username
		public function isNameValid(string $name): bool
		{
			$valid = TRUE;
			$len = mb_strlen($name);

			# Checks if username is greater than or equal
			# to 5 characters because otherwise either too short
			# of a username or too restrictive
			if ($len < 5)
			{
				$valid = FALSE;
			}
			return $valid;
		}

		# This method validates the password
		public function isPasswdValid(string $passwd): bool
		{
			$valid = TRUE;
			$len = mb_strlen($passwd);

			# Checks if pwd is greater than or equal to 5 characters
			# because otherwise the password is either too short
			# or the rules are too restrictive
			if ($len < 5)
			{
				$valid = FALSE;
			}
			return $valid;
		}
		public function isIdValid(int $id): bool
		{
			$valid = TRUE;
			if (($id < 1) || ($id > 1000000))
			{
				$valid = FALSE;
			}
			return $valid;
		}
		# This is the session login method
		# Time frame of 6 days
		public function sessionLogin(): bool
		{
			global $pdo;
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				$query =
				'SELECT * FROM pet_find.account_sessions, pet_find.accounts WHERE (account_sessions.session_id = :sid) ' .
				'AND (account_sessions.login_time >= (NOW() - INTERVAL 6 DAY)) AND (account_sessions.account_id = accounts.account_id) ' .
				'AND (accounts.account_enabled = 1)';
				$values = array(':sid' => session_id());
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
					throw new Exception('Database query error');
				}
				$row = $res->fetch(PDO::FETCH_ASSOC);
				if (is_array($row))
				{
					$this->id = intval($row['account_id'], 10);
					$this->name = $row['account_name'];
					$this->authenticated = TRUE;
					return TRUE;
				}
			}
			return FALSE;
		}

		# This method logs the user out
		public function logout()
		{
			global $pdo;

			$this->id = NULL;
			$this->name = NULL;
			$this->authenticated = FALSE;
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				$query = 'DELETE FROM pet_find.account_sessions WHERE (session_id = :sid)';
				$values = array(':sid' => session_id());
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
					throw new Exception('Database query error');
				}
			}
		}

		# Closes the PHP Sessions
		public function closeOtherSessions()
		{
			global $pdo;
			if (is_null($this->id))
			{
				return;
			}
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				$query = 'DELETE FROM pet_find.account_sessions WHERE (session_id != :sid) AND (account_id = :account_id)';
				$values = array(':sid' => session_id(), ':account_id' => $this->id);
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
					throw new Exception('Database query error');
				}
			}
		}


		public function getIdFromName(string $name): ?int
		{
			global $pdo;

			$id = NULL;
			$query = 'SELECT account_id FROM pet_find.accounts WHERE (account_name = :name)';
			$values = array(':name' => $name);
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
			$row = $res->fetch(PDO::FETCH_ASSOC);
			if (is_array($row))
			{
				$id = intval($row['account_id'], 10);
			}
			return $id;
		}


		# Saves the logins session
		private function registerLoginSession()
		{
			global $pdo;

			if (session_status() == PHP_SESSION_ACTIVE)
			{
				# Saves the session in SQL Database
				$query = 'REPLACE INTO pet_find.account_sessions (session_id, account_id, login_time) VALUES (:sid, :accountId, NOW())';
				$values = array(':sid' => session_id(), ':accountId' => $this->id);
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
					throw new Exception('Database query error');
				}
			}
		}
	}
