<div class="billgen"> 

    <div class="top_band"> 
        <div class="details"> 
            <div class="left"> <h1><?php echo $this->title; ?></h1></div>

            <div class="tranpopup">
                <div class="transname"><span class="arialwhit">Welcome, &nbsp;</span> <span class="arialwhitbld"><?php echo ($this->userName!='')?$this->userName : 'Guest'; ?></span></div>
                <div class="settingfld">
                    <?php if($this->userName!='') {?>
                    <div id="dd" class="wrapper-dropdown-3" tabindex="1" > <img src="/images/setting.jpg" width="19" height="18" border="0"  /></span>
                        <ul class="dropdown">
                            <div class="profilebox">
                                <div class="profile"><a   onClick="window.location = '<?php echo "/".$this->usertype; ?>/profile';"  class="navtxt">Profile</a></div>
                                 <div class="addteam"><a   onClick="window.location = '/profile/preferences';"  class="navtxt">Preferences </a></div>
                                <div class="addteam"><a   onClick="window.location = '/profile/reset';"  class="navtxt">Password reset </a></div>
                                
                                <div class="addteam"><a   onClick="window.location = '/logout';"  class="navtxt">Logout </a></div>
                            </div>
                        </ul>
                    </div>
                    <?php } ?>
                    
                    <!-- jQuery if needed -->
                  
                    <script type="text/javascript">

                                    function DropDown(el) {
                                        this.dd = el;
                                        this.placeholder = this.dd.children('span');
                                        this.opts = this.dd.find('ul.dropdown > li');
                                        this.val = '';
                                        this.index = -1;
                                        this.initEvents();
                                    }
                                    DropDown.prototype = {
                                        initEvents: function() {
                                            var obj = this;

                                            obj.dd.on('click', function(event) {
                                                $(this).toggleClass('active');
                                                return false;
                                            });

                                            obj.opts.on('click', function() {
                                                var opt = $(this);
                                                obj.val = opt.text();
                                                obj.index = opt.index();
                                                obj.placeholder.text(obj.val);
                                            });
                                        },
                                        getValue: function() {
                                            return this.val;
                                        },
                                        getIndex: function() {
                                            return this.index;
                                        }
                                    }

                                    $(function() {

                                        var dd = new DropDown($('#dd'));

                                        $(document).click(function() {
                                            // all dropdowns
                                            $('.wrapper-dropdown-3').removeClass('active');
                                        });

                                    });

                    </script>
                </div>
            </div>
        </div>
    </div>
       
    <?php
    if (isset($this->successMessage)) {
        ?> 
    <div class="gap"></div> 
    <div class="personal_details sadow" style="padding: 0 0 10px;">
<div class="suc">
<img src="/images/inf.gif" class="sucimg" /><p style="margin-left: 35px;"><?php echo $this->successMessage; ?></p>
</div>
    </div>
    <?php } ?>
    
       <?php
    if ($this->hasError()) {
        ?>  <div class="errormsg-box"> <img src="/images/erroor_msg.png" class="err-img" /> 

            <?php
            echo '<div class="right"> <ul>';
            foreach ($this->_error as $error_name) {
                ?> 
                <?php
                echo '<li style="padding-left: 15px;"><i class="icon-chevron-right"></i>' . $error_name[0] . ' -';
                $int = 1;
                while (isset($error_name[$int])) {
                    echo ' ' . $error_name[$int];
                    $int++;
                }
                echo '</li>';
            }
            ?>
            </ul></div></div>

<?php }
?>
 

