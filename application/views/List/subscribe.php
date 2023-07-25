
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Complex Headers -->
    <div class="card">

        <h5 class="card-header">Subscription List</h5>
        <div class="card-body">
        </div>

        <div class="table-responsive">
            <table class="table table-striped" id="table-1">
                        <thead>
                        <tr>
                             <th >
                              
                            </th>
                            <th >
                              Sr No
                            </th>
                           
                            <th>Email</th>
                          
                             
                            <th>Date & Time</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count=0; ?>
                        <?php foreach ($list as $value) : ?>
                          <?php $count++; ?>
                          <tr>
                                                          <td></td>

                            <td> <?php echo $count; ?></td>
                             
                             <td><?php echo $value['email']; ?></td>
                            
                           
                          

                           <td><?php echo date('d M, h:i:s a' ,strtotime($value['datetime'])); ?></td>
                          </tr>
                          <?php  endforeach ?>
                        </tbody>

                      </table>
        </div>

    </div>

    </div>




