Matthew Round - Technical Exercise 007 - function class


Usage
==========

For example see run.php.


Overview
========

I choose the design based on the requirement of a single Common Functions class.  
This for this is example is never initiated so I made it abstract. Its function 
determine() is suitable for this task. Errors are public and can be accessed 
directly. Each function is a class that extends from the function's class 
(Gtin and Delivery). Each of these return bool as requested.

I have kept the folder structure fairly straight forward for easy viewing.

The Gtin class is fairly straight forward.  The Delivery class is a little 
different.  It is initiated with a partner class so that the different 
delivery options can be utilised.


Notes
=====


* I took three hours or so to do this code. 
* I only tested with a Gtin length of 13. 
* Prior to doing this I had never heard of Gtin (just EAN). 
* Whilst this exercise is not fully tested it should be satisfactory to 
  determine if I am a suitable candidate for the role technically. 
* If this was a day to day task I would unit test each possible outcome.
* All code was by hand written in vim
* Code should meet psr2 standard (was ran through phpcs)
* I have added doc blocks for some explanation of the functions
* Code is name-spaced

Thanks for the test, I actually enjoyed doing this one!

Regards,
Matt
