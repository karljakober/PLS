PLS
===

Pong Lan Software


Installation

Sign up for github.com if you dont have an account

go to koding.com and sign up (not sign up with github!)

Click terminal (4th icon from left  ">_" )

run:
```
ssh-keygen -t rsa -C "your_email@example.com"
```

When it asks you for a filename just press enter

enter a password password (or dont, just hit enter)

run:
```
vim ~/.ssh/id_rsa.pub
```

copy the contents of the file (select text and ctrl c)

go to https://github.com/settings/ssh

Click 'add ssh key'

Give it a generic title and paste the key in

go back to koding (if vim is still open type :q and press enter to close the file)

run:
```
sudo apt-get install fabric -y
cd ~
git clone git@github.com:KarlJakober/PLS.git
sudo service mysql start
cd PLS
fab dev bootstrap
```

  (it will prompt you for MYSQL Root Password, just press enter!)
  if it hangs, close the terminal, start a new one and run
  
```
fab dev deploy
```
  
  
go to yourusername.kd.io