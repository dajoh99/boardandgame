# Board and Borrow
## Created By DAVID JOHNNY
**Board and Borrow** is a PHP-based web platform that allows users to browse, review, and "borrow" board games locally. It features a user authentication system, game catalog, cart functionality, and review submission.
## Live Features
### User Based
- User Registration and Login
- View and edit your profile
- Logout and account deletion with 
- Display username in nav bar after login
###  Game Catalog/Homepage
- Two categories: Local Games and Most Popular
- Cart add/remove system
###  Reviews
- Logged-in users can:
  - Select a game
  - Leave a comment
  - Submit a review
- Option to view all submitted reviews
## Setup
1. Import the SQL dump into your local MySQL server via phpMyAdmin
2.  Make sure the "product_catalog" and "user_registration" databases are imported
3. Run the project/site on a local server (starting from index.php)
## Known Issues
- The cart appears to disappear on the home page if you refresh or move sites but adding or removing a game makes them reappear
- Some parts may be available or unavailable depending on whether you are signed in or not; you'll directed to login most times but not every instance this happens due to oversight
- Database naming issues may cause the "Most Popular" games to not be added to the cart, but this doesn't happen most of the time (I don't know the instances in which this happens but it CAN happen)
- Games tab is functioning but empty, it was supposed to feature ALL games with descriptions but I didn't have to oppurtunity to do this
- About Tab was supposed to have more information on the site but I haven't gotten to it yet (if about section does work or has text ignore this)
## Features I didn't get to
- A way for each account to be able to delete their own comment/review, I initially had it so anyone could delete reviews but it didn't make sense
- A way for users to upload games themselves 
- Seller information would have been in the Games tab
- Initial plan was for every single game to have a distinct review/info page and a button to add it to cart (meaning cart would've been up no matter what part of the site you were on) but this was scrapped for time reasons
- Star Rating OR Number Rating system for Reviews
- Overall Fleshing out the site more