SELECT m.username, p.first_name, p.last_name FROM friends f JOIN members m ON f.friend_id=m.member_id JOIN profiles p ON p.member_id=m.member_id WHERE f.member_id=1;



