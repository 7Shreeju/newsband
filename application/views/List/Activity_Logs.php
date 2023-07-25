
<div class="container-xxl flex-grow-1 container-p-y">
                            
                            <!-- Complex Headers -->
                            <div class="card">

                                <h5 class="card-header">Activity Logs</h5>
                                <div class="card-body">
                        </div>

                                <div class="table-responsive">
                      <table class="table table-striped" id="example">
                        <thead>
                        <tr>
                            <th >
                              Sr No
                            </th>
                            <th>IP Address</th>
                            <th>User Id</th>
                             <th>Page</th>
                            <th>Page URL</th>
                              <th>Login Time</th>
                            <th>Account Name</th>
                            
                             <th>User Agent</th>
                             <th>Browser Name</th>
                            <th>Version</th>
                              <th>Platform</th>
                            <th>Device</th>
                              <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count=0; ?>
                        <?php foreach ($activity_logs as $value) : ?>
                          <?php $count++; ?>
                          <tr>
                            <td> <?php echo $count; ?></td>
                             <td><?php echo $value['ip_address']; ?></td> 
                             <td><?php echo $value['user_id']; ?></td> 

                            <td><?php echo $value['activity']; ?></td>
                             <td><?php echo $value['page_url']; ?></td>
                             <td><?php echo $value['logintime']; ?></td>
                             
                             
                                <td><?php echo $value['account_name']; ?></td> 

                            <td><?php echo $value['useragent']; ?></td>
                             <td><?php echo $value['name']; ?></td>
                             <td><?php echo $value['version']; ?></td>
                             
                            <td><?php echo $value['platform']; ?></td>
                             <td><?php echo $value['device']; ?></td>
                             <td><?php echo $value['createdDate']; ?></td>
                         
                          </tr>
                          <?php  endforeach ?>
                        </tbody>

                      </table>
                    </div>

                </div>


                <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>