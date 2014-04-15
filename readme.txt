===================================================
*** NOTE: SETUP INSTRUCTIONS CAN BE FOUND BELOW ***
===================================================


phpAbstracts v0.3 beta
http://www.phpabstracts.com

Copyright (c) 2008 Omar Qazi

phpAbstracts is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

phpAbstracts is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with phpAbstracts.  If not, see <http://www.gnu.org/licenses/>. 



===============
*** CREDITS ***
===============

phpAbstracts was originally created for a conference held by the RAISE 
Initiative in June 2008. It was developed by Omar Qazi, Website Manager. 
Ideas for the system were contributed by the entire team, notably 
Judy Austin, Head: Research, Monitoring and Evaluation.

RAISE is a joint initiative of the Columbia University Mailman School 
of Public Health and Marie Stopes International.

Versions 0.1 and 0.2 of the system were used internally by RAISE. It has 
been released as a free open-source system beginning with Version 0.3 in 
August 2008.



========================
*** ABOUT THE SYSTEM ***
========================

phpAbstracts is a free open-source system developed for the submission, 
review, and compilation of abstracts. While primarily designed for 
conferences, it is flexible enough to be used for other purposes.

The system allows anyone in the world to submit their abstracts through
a form on your website. The abstracts are collected at a central location,
where an administrator can then assign them for review to experts in 
various fields. When the reviewers login, they see the abstracts that
have been assigned to them, and are able to submit an online review.

Reviews and ratings are then compiled together for the administrator
to evaluate. The administrator can then assign abstracts to specific
types of presentations, as well as edit or delete them.

phpAbstracts automates a previously tedious manual process into an 
efficient, easy-to-use system.



=============
*** SETUP ***
=============

NOTE: MySQL Version 5+ is required!

1. Copy the entire phpabstracts directory to your server.
2. Turn on writable permissions to db.php (chmod 777).
3. Manually create an empty database. Remember what you name it.
4. In your browser, go to http://<yourwebsite>/phpabstracts/setup.php
5. Fill in the information, and hit Submit.
6. Turn off writable permissions on db.php (chmod 755).
7. Be sure to edit the variables in vars.php!



==================
*** HOW TO USE ***
==================

phpAbstracts is designed to be friendly and easy to use.

There are three basic roles in the system.

1. Submitters:
   This is the only role that does not require a login.
   Anyone can submit an abstract into the system. To do this, they simply 
   visit the page submit_form.php and fill in the form. Once an abstract
   is submitted, they can no longer access or edit it.

2. Admins:
   Admins are responsible for assigning abstracts to reviewers. They can also
   read the reviews written by each reviewer. Admins can also edit or delete 
   abstracts, as well as set the status on each one.

3. Users:
   Users are the reviewers of the abstracts.
   They can only view and review the abstracts that were assigned to them.



=====================
*** CUSTOMIZATION ***
=====================

There are a few things that you can easily customize in the system.

Colors and fonts can be changed in the css/abstracts.css file. 

A number of variables used throughout the site can be changed in the vars.php file.
This includes the Title, URL, Abstract Topics, Locations, etc.