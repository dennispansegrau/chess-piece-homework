Chess Piece Homework
===============
Link: https://thephp.cc/news/2021/01/here-is-your-homework  
13th January 2021
***
## Installation
```
composer install
```
## Execute
```
php bin/console chess [<board_position> [<chess_piece> [<chess_piece_color>]]]
```
All parameters are optional. Without an input a random value is chosen.  
<board_position> input format must be a letter and a number e.g. a1, e5, h8  
<chess_piece> input must be **K**ing, **Q**ueen, **R**ook, **B**ishop, K**N**ight or **P**awn  
<chess_piece_color> input must be **w**hite or **b**lack  

### Example commands
```
php bin/console chess a2 P w  
php bin/console chess e5 Q b  
php bin/console chess h4 K w  
```
