<div class="card shadow">
	<div class="card-body">
		<h5 class="card-title">Send a Message</h5>
		<form id="sendMessageForm" method="post" action="<?php echo $base_url . 'index.php/messages/send'?>">
        	<div class="d-flex flex-column">
        		<div class="mb-3 flex-fill">
            		<label for="exampleInputEmail1" class="form-label">Recipient</label>
            		<select class="form-select" aria-label="Default select example" name="recip" required>
            			<option value="" selected>Choose a recipient</option>
            			<?php foreach($recipients as $recip):?>
            			<option value="<?php echo $recip['username']?>"><?php echo $recip['first_name'].' '.$recip['last_name']?></option>
            			<?php endforeach; ?>
            		</select>
            	</div>
            	<div class="form-check form-switch flex-fill mb-3">
            		<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="y" name="pm" checked>
            		<label class="form-check-label" for="flexSwitchCheckDefault">Private Message</label>
            	</div>
        	</div>
        	<div class="mb-3">
        		<label for="exampleFormControlTextarea1" class="form-label">Message</label>
        		<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" required></textarea>
        	</div>
        	<button type="submit" class="btn btn-primary">Send</button>
        </form>	
	</div>
</div>

<div class="card mt-3 shadow">
	<div class="card-body">
	<h5 class="card-title">Messages</h5>
	<div class="d-flex align-items-start">
          <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-inbox" type="button" role="tab" aria-controls="v-pills-inbox" aria-selected="true">Inbox</button>
            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sent" type="button" role="tab" aria-controls="v-pills-sent" aria-selected="false">Sent</button>
          </div>
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-inbox" role="tabpanel" aria-labelledby="v-pills-home-inbox">
            <?php 
            $inbox_msg_empty = true;
            foreach ($messages as $msg) :
            if($msg['auth'] == lamp()->config->item('username')) {
                continue;
            }
            $inbox_msg_empty = false;
            ?>
            	<div class="card mb-2 shadow-sm">
            		<div class="card-body">
            			<h6><?=$msg['auth']?></h6>
            			<span class="text-muted"><?php echo date("m/d/Y - h:i a", $msg['time']);?></span>
            			<p><?php echo $msg['message']; ?></p>
            		</div>
            	</div>
            <?php endforeach;?>
            <?php 
            if($inbox_msg_empty) {
                echo "No messages in inbox.";
            }
            ?>
            </div>
            <div class="tab-pane fade" id="v-pills-sent" role="tabpanel" aria-labelledby="v-pills-profile-sent">
            
            <?php 
            $sent_msg_empty = true;
            foreach ($messages as $msg) :
            if($msg['recip'] == lamp()->config->item('username')) {
                continue;
            }
            $sent_msg_empty = false;
            ?>
            	<div class="card mb-2 shadow-sm">
            		<div class="card-body">
            			<h6><?=$msg['recip']?></h6>
            			<span class="text-muted"><?php echo date("m/d/Y - h:i a", $msg['time']);?></span>
            			<p><?php echo $msg['message']; ?></p>
            		</div>
            	</div>
            <?php endforeach;?>
            <?php 
            if($sent_msg_empty) {
                echo "No sent messages.";
            }
            ?>
            
            </div>
          </div>
        </div>
		
	</div>
</div>
