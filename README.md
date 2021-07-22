# rust-forum
Forum related to the game Rust in Javascript/Ajax/MySQL/PHP (dynamically generated content)

#What is this mini masterpiece?
I created a mini forum for the survival game Rust based on the article system:
- viewing, adding articles by a regular user (user),
- viewing, modifying, deleting by a privileged one (root),

Content is dynamically generated to the elements on the page.
Additionally I used md5 encryption in the database using PHP functions to protect myself from passwords leaks haha
The user interface is intuitive and neat.
The project was created using XAMP on localhost (https://www.apachefriends.org/pl/index.html) Apache, MySQL.
I did the project a few time ago. I really had a lot of fun back then :D

#Database:
I attach a database to the project, so its *accs_rustforum.sql*
There are two users by default:
1. [login]: "user", [password]: "userpassword"
2. [login]: "root", [password]: "rootpassword"
