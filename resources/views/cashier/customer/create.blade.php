                                <!-- Modal -->
                                <div id="dataModal" class="modal fade">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('customer.store')}}" method="post" enctype="multipart/form-data">
                                             {{ csrf_field() }}
                                            <div class="modal-body">
                                             <div class="form-group row">
                                                <label for="cat_name" class="col-sm-3 text-right control-label col-form-label">Category Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="cust_name" name="cust_name" placeholder="Customer Name Here">
                                                    @if ($errors->has('cust_name'))
                                                        <span class="text-danger">{{ $errors->first('cust_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Mo.No</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="phone" name="phone">
                                                    @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                         </form>
                                        </div>
                                    </div>
                                </div>