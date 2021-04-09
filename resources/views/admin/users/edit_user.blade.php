@extends('admin.master_admin')
@section('content')
<div class="col-md-8">
    <div class="card">
                 <div class="card-body">
                     <!-- Nav tabs -->
                     <ul class="nav nav-tabs " role="tablist">
                         <li class="nav-item">
                             <a class="nav-link {{--($op != "myorder")?'active':null--}}" data-toggle="tab" href="#profile" role="tab">
                                 <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                 <span class="d-none d-sm-block"><?php echo __('view.profile');?></span> 
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" data-toggle="tab" href="#address" role="tab">
                                 <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                 <span class="d-none d-sm-block"><?php echo __('view.address_delivery'); ?></span> 
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link myorder {{--($op == "myorder")?'active':null--}}" data-toggle="tab" href="#order" role="tab">
                                 <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                 <span class="d-none d-sm-block"><?php echo __('view.order_list');?></span>   
                             </a>
                         </li>
                     </ul>

                     <!-- Tab panes -->
                     <div class="tab-content">
                         <div class="tab-pane p-3 {{--  ($op != "myorder")?'active':null--}}" id="profile" role="tabpanel">
                             <form method="post" action="<?php echo url('profile/save');?>">
                                 <?php echo csrf_field();?>
                                 <input type="hidden" name="user_id" value="{{--   echo $user->id;--}}">
                                 <h5 class="text-primary"><?php echo __('view.user_info');?></h5>
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label><?php echo __('view.fullname');?> <span class="text-danger">*</span></label>
                                             <input type="text" name="name" class="form-control" value="{{--   echo (old('name')?old('name'):$user->name);--}}">
                                         </div>
                                     </div>
                                      <div class="col-md-6">
                                         <div class="form-group">
                                             <label><?php echo __('view.email');?> <span class="text-danger">*</span></label>
                                             <input type="text" name="email" class="form-control" value="{{--  echo (old('email')?old('email'):$user->email);--}}">
                                         </div>
                                     </div>
                                 </div>
                                 <h5 class="text-primary"><?php echo __('view.contact_info');?></h5>
                                 <div class="row">
                                     <div class="col-md-4">
                                         <div class="form-group">
                                             <label><?php echo __('view.phone');?> </label>
                                             <input type="text"  name="phone" class="form-control" value="{{--  echo (old('phone')?old('phone'): $user->phone);--}}">
                                         </div>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="form-group">
                                             <label><?php echo __('view.line');?> </label>
                                             <input type="text" name="line" class="form-control" value="{{--  echo (old('line')?old('line'): $user->line); --}}">
                                         </div>
                                     </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="control-label"><?php echo __('view.facebook');?></label>
                                             <div class="input-group">
                                                 <span class="input-group-addon input-group-prepend">
                                                     <span class="input-group-text">facebook.com/</span>
                                                 </span>
                                                 <input type="text" value="{{--   echo (old('facebook')?old('facebook'): $user->facebook);--}}" name="facebook" class="form-control">
                                             </div>
                                             
                                         </div>
                                     </div>
                                 </div>
                                 <h5 class="text-primary"><?php echo __('view.password_info')?></h5>
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label><?php echo __('view.password');?> <span class="text-sm text-danger"><?php echo __('view.empty_if_dont_change');?></span> </label>
                                             <input type="password" name="password" class="form-control" >
                                         </div>
                                        
                                     </div>
                                      <div class="col-md-6">
                                         <div class="form-group">
                                             <label><?php echo __('view.password_confirm');?> </label>
                                             <input type="password" name="password_confirm" class="form-control" >
                                         </div>
                                     </div>
                                     
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                         <button type="submit" class="btn btn-block btn-primary">บันทึกข้อมูล</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                         <div class="tab-pane p-3" id="" role="tabpanel">
                         
                                 {{--   foreach($address as $index=>$addr): --}}
                                 <div user_address_id="{{--  echo $addr->id; --}}" class="card card_user_address p-10" style="border:1px solid #bdbcbc">
                                     <div class="card-body m-b-0">
                                         <div class="address_action float-right text-center">
                                         {{-- 
                                         $addr_class = 'btn-outline-success';
                                         if($addr->is_default == 1)
                                         {
                                             $addr_class = 'btn-success';
                                         }
                                          --}}
                                             <button address_id="{{-- $addr->id --}}" address_default="{{-- $addr->is_default --}}" type="button" style="margin-bottom:5px" class="btn btn-sm  waves-effect waves-light"><i class="fas fa-check"></i> ที่อยู่หลัก</button>
                                             <br>
                                             <button type="button" class="btn btn-sm btn-outline-danger delete_user_address"><i class="far fa-trash-alt"></i> ลบ</button>
                                             <button type="button" class="btn btn-sm btn-outline-info edit_user_address"><i class="far fa-edit"></i> แก้ไข</button>
                                         </div>
                                         {{-- echo $addr->name_address;--}}
                                         <h6 style="margin-bottom:0px">{{--  echo $addr->address.' '.$addr->province->name,' ',$addr->zipcode; --}}</h6>
                                         <span class="text-muted" style="margin-bottom:0px"><i class="fas fa-user-tag"></i> {{--  echo $addr->name_contact.' ,'.$addr->phone; --}}</span>
                                         
                                     </div>
                                 </div>
                                 {{-- endforeach;--}}
                                <button type="button" id="add_new_address_btn" class="btn btn-primary">+ <?php echo __('view.address');?></button>
                             
                         </div>
                         <div class="tab-pane p-3 {{--($op == "myorder")?'active':null--}}" id="order" role="tabpanel">
                             <div class="row">
                                 <div class="col-12" style="overflow-x:auto;">
                                     <table class="table table-hover w-100" id="table_order" remote_url="">
                                         <thead>
                                             <tr>
                                                 <th width="15%">{{ __('view.order_id') }}</th>
                                                 <th width="20%">{{ __('view.order_date') }}</th>
                                                 <th width="20%">ชื่อร้าน</th>
                                                 <th width="15%">{{ __('view.total') }}</th>
                                                 <th width="15%">{{ __('view.status') }}</th>
                                                 <th ></th>
                                             </tr>
                                         </thead>
                                     </table>
                                     
                                 </div>
                                 
                             </div>

                         </div>
                
                     </div>

                 </div>
             </div>
</div>
@stop