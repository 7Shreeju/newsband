
<div class="container-xxl flex-grow-1 container-p-y">
                            
                            <!-- Complex Headers -->
                            <div class="card">

                                <h5 class="card-header">Paid Subscription List</h5>
                                <div class="card-body">
                        </div>

                                <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                        <tr>
                            <th >
                              Sr No
                            </th>
                            <th>Name</th>
                             <th>mobile</th>
                            <th>Plan</th>
                             <th>Purchased Date</th>
                             <th>Expiry Date</th>
                             <th>Transaction ID</th>
                              <th>Amount</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count=0; ?>
                        <?php foreach ($list as $value) : ?>
                          <?php $count++; ?>
                          <tr>
                            <td> <?php echo $count; ?></td>
                             <td><?php echo $value['name']; ?></td> 
                             <td><?php echo $value['contact']; ?></td>
                             <td><?php echo $value['plan']; ?></td>
                              <td><?php echo $value['from']; ?></td>
                               <td><?php echo $value['to']; ?></td>
                                <td><?php echo $value['transaction_id']; ?></td>
                                 <td><?php echo $value['amount']; ?></td>
                            
                          </tr>
                          <?php  endforeach ?>
                        </tbody>

                      </table>
                    </div>

                </div>

     </div>
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">    
        <div class="modal-dialog" role="document">     
            <div class="modal-content">            <div class="modal-header">                
                    <h5 class="modal-title" id="modalLongTitle">Message</h5>             
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>       

                </div>         
                <div class="modal-body">            
                    <p id="message" ></p>          
                </div>           
                <div class="modal-footer">            
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>           
                </div>       
            </div>  
        </div>
    </div>          



