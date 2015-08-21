<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<div id="container">
<h1>Do you need an account?????</h1>

<div id="body">
<?php if (empty($user_sess)): ?>
<a href='./account/register'>注册</a> || <a href='./account/login'>登陆</a>
<?php else: ?>
<ul>
<li><?=$user_sess['user_email']?></li>
<li><a href='./account/logout'>登出</a></li>
</ul>
<?php endif; ?>
</div>
