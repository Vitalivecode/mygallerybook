    <!--main content start-->
    <section id="main-content" style="padding:5px;">
      <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Payments</h3>
          <div class="row mb">
              
            <div class="content-panel" style="padding:5px;">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Subscription Pack</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th class="none">Pack Details</th>
                    <th>Pack EndDate</th>
                    <th>Remain Albums</th>
                    <th>Payment Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                foreach($payments as $row):
                ?>
                <tr>
                    <th><?= $row->sName ?></th>
                    <th><?= $row->cFName ?><?= $row->cLName ?></th>
                    <th><?= $row->cPhone ?></th>
                    <th><br><?= $row->sName ?><br><i class="fa fa-rupee">&nbsp;<?= $row->sCost ?></i><br><?= $row->sMonths ?> Months <br><?= $row->sAlbums ?> Albums<br><?= $row->sDescription ?></th>
                    <th><?php echo date('d-m-Y', strtotime($row->sEndDate));?></th>
                    <th><?= $row->sRemainAlbums ?></th>
                    <td><?php echo date('d-m-y h:i A', strtotime($row->paymentAt));?></td> 
                </tr>
                <?php
                endforeach;
                ?>
                </tbody>
              </table>
            </div>
            </div>
          
          </div>
      </section>
    </section>
    <!--main content end-->