@extends('layouts.app')
@section('page-content')
  
  <!-- View Category -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>View Category</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/candidate/dashboard">Home</a></li>
              <li>View Category</li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>

    <!-- Page Content -->
    <div class="utf-dashboard-content-inner-aera"> 
      <div class="row"> 
        <div class="col-xl-12">
          <div class="mb-2">
            <a href="javascript:void(0);" class="button utf-ripple-effect-dark">Add Categpry</a>      
          </div>
        </div>
      </div>

      <div class="row">
      <div class="col-xl-12">
        <div class="utf_dashboard_list_box table-responsive recent_booking dashboard-box">
        <div class="dashboard-list-box table-responsive invoices with-icons">
          <table class="table table-hover">
          <thead>
            <tr>
            <th>Order ID</th>
            <th>Profile</th>
            <th>Plan Package</th>
            <th>Expiry Plan</th>
            <th>Payment Type</th>
            <th>Status</th>
            <th>View Booking</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td>0431261</td>
            <td><img alt="" class="img-fluid rounded-circle shadow-lg" src="images/thumb-1.jpg" width="50" height="50" data-tippy-placement="top" data-tippy="" data-original-title="John Williams"></td>
            <td>Standard Plan</td>
            <td>12 Dec 2020</td>
            <td>Paypal</td>
            <td><span class="badge badge-pill badge-primary text-uppercase">Approved</span></td>
            <td><a href="#" class="button gray"><i class="icon-feather-eye"></i> View Detail</a></td>
            </tr>
            <tr>
            <td>0431262</td>
            <td><img alt="" class="img-fluid rounded-circle shadow-lg" src="images/thumb-1.jpg" width="50" height="50" data-tippy-placement="top" data-tippy="" data-original-title="John Williams"></td>
            <td>Extended Plan</td>
            <td>12 Dec 2020</td>
            <td>Credit Card</td>
            <td><span class="badge badge-pill badge-primary text-uppercase">Approved</span></td>
            <td><a href="#" class="button gray"><i class="icon-feather-eye"></i> View Detail</a></td>
            </tr>
            <tr>
            <td>0431263</td>
            <td><img alt="" class="img-fluid rounded-circle shadow-lg" src="images/thumb-1.jpg" width="50" height="50" data-tippy-placement="top" data-tippy="" data-original-title="John Williams"></td>
            <td>Standard Plan</td>
            <td>12 Dec 2020</td>
            <td>Paypal</td>
            <td><span class="badge badge-pill badge-danger text-uppercase">Pending</span></td>
            <td><a href="#" class="button gray"><i class="icon-feather-eye"></i> View Detail</a></td>
            </tr>
            <tr>
            <td>0431264</td>
            <td><img alt="" class="img-fluid rounded-circle shadow-lg" src="images/thumb-1.jpg" width="50" height="50" data-tippy-placement="top" data-tippy="" data-original-title="John Williams"></td>
            <td>Basic Plan</td>
            <td>12 Dec 2020</td>
            <td>Paypal</td>
            <td><span class="badge badge-pill badge-danger text-uppercase">Pending</span></td>
            <td><a href="#" class="button gray"><i class="icon-feather-eye"></i> View Detail</a></td>
            </tr>
            <tr>
            <td>0431265</td>
            <td><img alt="" class="img-fluid rounded-circle shadow-lg" src="images/thumb-1.jpg" width="50" height="50" data-tippy-placement="top" data-tippy="" data-original-title="John Williams"></td>
            <td>Extended Plan</td>
            <td>12 Dec 2020</td>
            <td>Paywith Stripe</td>
            <td><span class="badge badge-pill badge-danger text-uppercase">Pending</span></td>
            <td><a href="#" class="button gray"><i class="icon-feather-eye"></i> View Detail</a></td>
            </tr>
            <tr>
            <td>0431266</td>
            <td><img alt="" class="img-fluid rounded-circle shadow-lg" src="images/thumb-1.jpg" width="50" height="50" data-tippy-placement="top" data-tippy="" data-original-title="John Williams"></td>
            <td>Basic Plan</td>
            <td>12 Dec 2020</td>
            <td>Paypal</td>
            <td><span class="badge badge-pill badge-canceled text-uppercase">Canceled</span></td>
            <td><a href="#" class="button gray"><i class="icon-feather-eye"></i> View Detail</a></td>
            </tr>
          </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>


       
       
        
        <!-- Footer -->
        <div class="utf-dashboard-footer-spacer-aera"></div>
        <div class="utf-small-footer margin-top-15">
          <div class="utf-small-footer-copyrights">Copyright &copy; 2020 All Rights Reserved.</div>
        </div>        
      </div>
    <!-- Page Content ends -->
  </div>    
</div>
@endsection
