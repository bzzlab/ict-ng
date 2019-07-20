## ICT teaching material
<small>Author: [Daniel Garavaldi](mailto:daniel.garavaldi@bzz.ch)</small>

### Introduction
This simple PHP based webapp is used as a platform to upload and publish teaching material
(textbooks written in markdown about various topics web design and programming with source 
code and working demos).

### Why I don't apply well known education platforms 
I don't apply Moodle because
* it's far away to be user friendly (main reason) and self explainable.
* I need to work offline and it's sufficient for me to upload 
* I don't need vast amount of features that usually don't work out of the box


### Demonstration
You can have a look [http://ict.bzzlab.ch](http://ict.bzzlab.ch). I admit it's not 
a show case to promote but it works for my lessons and with a few clicks I can demo 
the complicated source in a new web page tab. 

### Directory structure
The content (directory <code>data</code>) is not uploaded on github because its quite large.
* Code <code>lp01, lp02, ... </code> is used for the teacher 01, teacher 02 ..
* Year of the various classes are coded by the date<code>2017, 2018, ...</code>.
* Two-digit numbers stand for semester (1 to 8).
* At last (but not least) level directories for exams, organizing subject (org), topics (themen)
are located.
 
The proposed directory structure looks as follows: 
```
data/
    lp01/
        2017/
            01/      
                exam            
                feedbacks                   
                org             
                ressourcen      
                themen
             02/      
                exam            
                feedbacks                   
                org             
                ressourcen      
                themen
        2018/
            ...
    lp02/
        2017/
            exam            
            feedbacks                   
            org             
            ressourcen      
            themen
        2018/
            ...
```

### Frameworks used
* CSS-Framework Bootstrap v4.3.1
* Parsedown for rendering der markdown textbooks
* <mark>complete URLs and version for credits</mark>