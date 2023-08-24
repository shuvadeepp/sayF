@extends('layouts.website')
@section('page-content')
@section('page-css')

@endsection
<!-- <div class="page-wrapper"> -->

<!-- Job post -->
<div class="section padding-top-60 padding-bottom-60">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="dashboard-box">
          <div class="headline">
            <h3>Job Information</h3>
          </div>
          <div class="content with-padding padding-bottom-10">
            <div class="row">
              <div class="col-12">
                <div class="utf-submit-field">
                  <h2 class="mb-2">Job Title</h2>
                  <input type="text" class="utf-with-border" placeholder="Job Title">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="utf-submit-field">
                  <h5>Location</h5>
                  <div class="utf-input-with-icon">
                    <input class="utf-with-border" type="text" placeholder="Type Address">
                    <i class="icon-material-outline-location-on"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="utf-submit-field">
                  <h5>No. of Vacancies</h5>
                  <input type="number" class="utf-with-border" placeholder="No. of Vacancies" min="0" >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="utf-submit-field">
                  <h5>Job Type</h5>
                  <select class="selectpicker utf-with-border" data-size="7" title="Select Job Type">
                    <option>Full Time Jobs</option>
                    <option>Part Time Jobs</option>
                  </select>
                </div>
              </div>   
            </div>
            <div class="row">
              <div class="col-12">
                <div class="utf-submit-field">
                  <h5>Job Description</h5>
                  <textarea cols="40" rows="2" class="utf-with-border"
                    placeholder="Job Description..."></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="utf-submit-field">
                  <h5>Roles & Responsibilities</h5>
                  <input type="text" class="utf-with-border" placeholder="Roles and Responsibilities">
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-12">
                <div class="utf-submit-field">
                  <h5>Key Skills <span class="text-light d-block">(Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto eos architectoLorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto eo distinctio!)</span>
                  </h5>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="keywords-container">
                        <div class="keyword-input-container">
                          <input type="text" class="keyword-input utf-with-border"
                            placeholder="E.g CSS, Photoshop, Js, Bootstrap" />
                          <button class="keyword-input-button ripple-effect"><i
                              class="icon-material-outline-add"></i></button>
                        </div>
                        <div class="keywords-list">
                          <!-- keywords go here -->
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="utf-submit-field">
                  <h5>Work Experience</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <select class="selectpicker utf-with-border" data-value="Minimum" data-size="7" title="Minimum">
                        <option>1 Year</option>
                        <option>1.5 Year</option>
                        <option>2 Year</option>
                        <option>2.5 Year</option>
                        <option>3 Year</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <select class="selectpicker utf-with-border" data-value="Maximum" data-size="7" title="Maximum">
                        <option>1 Year</option>
                        <option>1.5 Year</option>
                        <option>2 Year</option>
                        <option>2.5 Year</option>
                        <option>3 Year</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="utf-submit-field">
                  <h5>Annual Salary Range</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <select class="selectpicker utf-with-border" data-size="7" title="Minimum">
                        <option>Less than 1 lakh</option>
                        <option>1 to 5 lakh</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <select class="selectpicker utf-with-border" data-size="7" title="Maximum">
                        <option>Less than 1 lakh</option>
                        <option>1 to 5 lakh</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="utf-submit-field">
                  <h5>Industry</h5>
                  <select class="selectpicker utf-with-border" data-size="7" title="Industry">
                    <option>Software</option>
                    <option>HardWare</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="utf-submit-field">
                  <h5>Minimum Education Qualification</h5>
                  <select class="selectpicker utf-with-border" data-size="7" title="Minimum Education Qualification">
                    <option>Graduate</option>
                    <option>Postgraduate</option>
                  </select>
                </div>
              </div>    
            </div>
            <div class="row">
              <div class="col-12">
                <div class="utf-submit-field">
                  <h5>Company Details</h5>
                  <textarea cols="40" rows="2" class="utf-with-border"
                    placeholder="Company Details..."></textarea>
                </div>
              </div>
            </div>
          
          </div>
          <div class="utf-centered-button margin-bottom-40">
            <a href="javascript:void(0);" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0" >Submit Jobs <i class="icon-feather-plus"></i></a>			
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Job post  / End -->
@endsection