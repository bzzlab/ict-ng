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
* Last (but not least) level directories for exams, organizing subject (org), topics (themen)
are located.
 
The proposed directory structure looks as follows: 
```
data/
    lp01/
        2017/
            01/      
                exam            
                feedbacks                   
                org/
                    inc             
                ressourcen      
                themen
             02/      
                exam            
                feedbacks                   
                org/
                    inc           
                ressourcen      
                themen
             ...
        2018/
            ...
    lp02/
        2017/
            exam            
            feedbacks                   
            org/
                inc             
            ressourcen      
            themen
        2018/
            ...
```


### Handling content
The content is written either in plain HTML oder in [Markdown](https://de.wikipedia.org/wiki/Markdown).
In order to keep <code>agenda.md</code> small where <code>...content.php?inc=1&...</code> (with the GET parameter inc) 
can render included files and markdowns.
In the example below <code>inc</code>-directory is used/referenced for rendering markdown-files.

```
...
<a name="00"></a>
<a id="00---01022019---organisation-vorbereitung-lb01"></a>
### 00 - 01.02.2019 - Organisation, Vorbereitung LB01

{{inc/organisation.md}}

{{inc/lb01-prep.md}}

<a name="01"></a>
<a id="01---08022019---webframework-installieren-und-anwenden-lb01"></a>
### 01 - 08.02.2019 - Webframework installieren und anwenden, LB01

{{../themen/frameworks/bootstrap/ue/boostrap_basic.md}}

{{inc/lb01.md}}
...
```


### Frameworks used
* CSS-Framework Bootstrap v4.3.1
* Parsedown for rendering der markdown textbooks
* <mark>complete URLs and version for credits</mark>