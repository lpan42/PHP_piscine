<?php
    header("Content-Type: text/plain");
?>
 <html><body>Hello</body></html>
<!-- must be called before any actual output is sent, either by normal HTML tags, 
blank lines in a file, or from PHP. -->
<!-- PHP automatically sets the  Content-Type header to text/html
if you don't override it so your browser is treating it as an HTML file 
that doesn't contain any HTML. -->