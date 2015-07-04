<div id="container">
    <h1>Do you need an account?</h1>
    
    <div id="body">
        <form action="account/login">
            <input type='text' id='ac'></input>
            <input type='submit'></input>
            <a href='./account/register'>注册</a>
        </form>
    </div>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>