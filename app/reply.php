<script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#forwardemail" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 1,
            source: function( request, response ) {
                // delegate back to autocomplete, but extract the last term
                $.getJSON("http://localhost/hestabit/app/skills.php", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );
                return false;
            }
        });
    });
    </script>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal3" class="modal fade" style="display: none;">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                          <h4 class="modal-title">Forward</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">To</label>
                                                  <div class="col-lg-10">
                                                      <input type="email" placeholder="Enter Email" id="forwardemail" name="to3" class="form-control"  multiple >
                                                      <!-- <datalist id="emails">
                                                        <?php// foreach ($users as $user ) {
                                                        ?>
                                                        <option value=" <?php //echo $user; ?>">
                                                      <?php //} ?>  
                                                      </datalist> -->
                                                  </div>
                                              </div>
                                              
                                              <div class="form-group" >
                                                  <label class="col-lg-2 control-label">Subject</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" placeholder=""  value ="<?php   echo "Fwd :" . $inbox_msg['subject']; ?> " id="inputPassword1" name="subject3" class="form-control"  >
                                                      <input type="text" name="parentid3" value="<?php echo $inbox_msg['parentid'];?>" hidden>
                                                      <input type="text" name="messageid3" value="<?php echo $inbox_msg['msgid'];?>" hidden>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Message</label>
                                                  <div class="col-lg-10">
                                                      <textarea rows="10" cols="30" class="form-control" id="" name="message3"></textarea>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                        <span>Attachment</span>
                                                        <input type="file" name="files3[]" multiple>
                                                      </span>
                                                      <button class="btn btn-send" type="submit" name="submit3">Send</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal1<?php echo $b;?>" class="modal fade" style="display: none;">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                          <h4 class="modal-title">Reply to All</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">To</label>
                                                  <div class="col-lg-10">
                                                      <input type="email" placeholder="" value="<?php echo $value['fromid'] ;?> 
                                                       " id="inputEmail1" name="to1" class="form-control" list="emails" multiple  >
                                                      <!-- <datalist id="emails">
                                                        <?php //foreach ($users as $user ) {
                                                        ?>
                                                        <option value=" <?php //echo $user; ?>">
                                                      <?php //} ?>  
                                                      </datalist> -->
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Cc</label>
                                                  <div class="col-lg-10">
                                                      <input type="email" placeholder="" id="cc" name="cc1" class="form-control" value="<?php //print_r($s); die;
                                  
                                      if(count($s) >1){ 
                                                                
                                         for($x=count($s)-1; $x>=0; $x--){
                                          
                                            if($x==0) {
                                              /*if ($s[$x]['status'] == 0) {*/
                                                if($email != $s[$x]['to_ccid']) {
                                                echo $s[$x]['to_ccid'];} }
                                            else {
                                              /*if ($s[$x]['status'] == 0) {*/
                                                if($email != $s[$x]['to_ccid']) {
                                                echo $s[$x]['to_ccid'] . ",";} }
                                          
                                        }
                                        }
                                        else 
                                          if($s['0']['status'] == 0)
                                            {echo $s['0']['to_ccid']; } ?> " list="emails" multiple>

                                                      <datalist id="emails">
                                                        <?php foreach ($users as $user ) {
                                                        ?>
                                                        <option value=" <?php echo $user; ?>">
                                                      <?php } ?>  
                                                      </datalist>
                                                  </div>
                                              </div>
                                              <div class="form-group" style="display: none">
                                                  <label class="col-lg-2 control-label">Subject</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" placeholder=""  value ="<?php  if((stripos($inbox_msg['subject'], "RE: ") !== false)){
    echo  $inbox_msg['subject'];
  }
  else {
    echo "RE: " . $inbox_msg['subject'];
  } ?> " id="inputPassword1" name="subject1" class="form-control" hidden>
                                                      <input type="text" name="parentid1" value="<?php echo $inbox_msg['parentid'];?>">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Message</label>
                                                  <div class="col-lg-10">
                                                      <textarea rows="10" cols="30" class="form-control" id="" name="message1"></textarea>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                        <span>Attachment</span>
                                                        <input type="file" name="files1[]" multiple>
                                                      </span>
                                                      <button class="btn btn-send" type="submit" name="submit1">Send</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->






<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal2<?php echo $b;?>" class="modal fade" style="display: none;">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                          <h4 class="modal-title">Reply</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">To</label>
                                                  <div class="col-lg-10">
                                                      <input type="email" placeholder="" value="<?php echo $value['fromid'] ;?>" id="inputEmail1" name="to2" class="form-control" list="emails" multiple  >
                                                      <!-- <datalist id="emails">
                                                        <?php// foreach ($users as $user ) {
                                                        ?>
                                                        <option value=" <?php //echo $user; ?>">
                                                      <?php //} ?>  
                                                      </datalist> -->
                                                  </div>
                                              </div>
                                              
                                              <div class="form-group" >
                                                  <label class="col-lg-2 control-label">Subject</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" placeholder=""  value ="<?php  if((stripos($inbox_msg['subject'], "RE: ") !== false)){
    echo  $inbox_msg['subject'];
  }
  else {
    echo "RE: " . $inbox_msg['subject'];
  } ?> " id="inputPassword1" name="subject2" class="form-control"  >
                                                      <input type="text" name="parentid2" value="<?php echo $inbox_msg['parentid'];?>" hidden>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Message</label>
                                                  <div class="col-lg-10">
                                                      <textarea rows="10" cols="30" class="form-control" id="" name="message2"></textarea>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                        <span>Attachment</span>
                                                        <input type="file" name="files2[]" multiple>
                                                      </span>
                                                      <button class="btn btn-send" type="submit" name="submit2">Send</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->



