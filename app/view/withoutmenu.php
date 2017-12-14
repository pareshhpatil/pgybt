<div class="billgen">
    <div class="top_band">
        <div class="details">
            <div class="left">
                <h1 style="width: 500px;"><?php echo $this->title; ?></h1>
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
            <div class="right"> <ul>
                    <?php
                    foreach ($this->_error as $error_name) {
                        ?> 
                        <?php
                        echo '<li style="padding-left: 15px;"><i class="icon-chevron-right"></i>' . $error_name[0] . ' -';
                        $int = 1;
                        while (isset($error_name[$int])) {
                            echo '' . $error_name[$int];
                            $int++;
                        }
                        echo '</li>';
                    }
                    ?>
                </ul></div></div>

    <?php }
    ?>
 


