Matthew Round - Technical Exercise 007 - function class


how to use
==========

For example see run.php.


overview
========

I choose the design based on the requirement of a single Common Functions class.  This for this is example is never ititiated so I made it abstract. Its function determine() is suitable for this task. Errors are public and can be accessed directly. Each function is a class that extends from the function's class (Gtin and Delivery). Each of these return bool as requested.

I have kept the folder structure fairly striaghtforward for easy viewing.

The Gtin class is fairly straight forward.  The Delivery class is a little different.  It is itiated with a partner class so that the different delivery options can be utilised.


Notes
=====

I took two and a half hours to do this code. I only tested the a gtin length of 13. Prior to doing this I had never heard of gtin (just ean). Whilst this excersise is not fully tested it should be satisfactory to determine if I am a suitable candidate for the role technically. If this was a day to day task I would unit test each possible outcome.

Thanks for the test, I actually enjoyed doing this one!
Regards,
Matt
