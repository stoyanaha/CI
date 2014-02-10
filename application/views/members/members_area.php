
<p> Hello: <b><?php echo $this->session->userdata('username');   ?> </b>
        <?php echo anchor('login/logout', 'abmelden');  ?>
</p>
