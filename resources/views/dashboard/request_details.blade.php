@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<div class="page">
    <div class="page-content container-fluid">
      <div class="example-wrap">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-block pt-4 pl-4 pb-0">
                <h4 class="" style="color:#232e74;font-weight: 500;padding-left: 13px;">Request Details</h4>
              </div>
              <div class="example-wrap">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Standard Card -->
                    <div class="res_card">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Basic Details</b></div>
                          <div><i class="fa-solid fa-pen-to-square"></i></div>
                        </div>
                        <div class="card-text">
                          <table>
                            <tr>
                              <td style="padding-right: 15px;">Name</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>Sai</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 15px;">Gender</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>Male</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 15px;">Age</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>27</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 15px;">Priority</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>Normal</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 15px;">Condition</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>Suffering with fever</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 15px;">Blood Group</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>B +ve</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 15px;">Weight</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>60</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 15px;">Height</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>6 Feet</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Card Image overlays -->
                    <div class="res_card">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Medical History</b></div>
                          <div><i class="fa-solid fa-pen-to-square"></i></div>
                        </div>
                        <div class="card-text">
                          <table>
                            <tr>
                              <td style="padding-right: 15px;">Medicine Name</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>Crosin</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 15px;">Using Since From</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>Last Month</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 15px;">Frequency</td>
                              <td style="padding-right: 15px;">:</td>
                              <td>Morning, Evening</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <!-- End Example Card Image overlays -->
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Standard Card -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Prescription</b></div>
                          <div><i class="fa-solid fa-pen-to-square"></i></div>
                        </div>
                        <div class="card-text mt-2">
                          <img src="assets/images/pres.png" width="100px">
                          <img src="assets/images/pres.png" width="100px">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Card Image overlays -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>RX</b></div>
                          <div><i class="fa-solid fa-pen-to-square"></i></div>
                        </div>
                        <div class="card-text mt-2">
                          <img src="assets/images/pres.png" width="100px">
                          <img src="assets/images/pres.png" width="100px">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Example Card Image overlays -->
                </div>
                <div class="row mt-4">
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Standard Card -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Allergies</b></div>
                          <div><i class="fa-solid fa-pen-to-square"></i></div>
                        </div>
                        <div class="card-text mt-2">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Card Image overlays -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Medical Conditions</b></div>
                          <div><i class="fa-solid fa-pen-to-square"></i></div>
                        </div>
                        <div class="card-text mt-2">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Example Card Image overlays -->
                </div>
                <div class="row mt-4">
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Standard Card -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>LifeStyle</b></div>
                          <div><i class="fa-solid fa-pen-to-square"></i></div>
                        </div>
                        <div class="card-text mt-2">
                          <ol class="p-3 ml-13">
                            <li>
                              Do you get at least thirty minutes of exercise or activity each day?

                            </li>
                            <div>
                              <input type="checkbox" id="1" name="radio-button" value="css" checked />
                              <label>
                                <b>Yes</b>
                             </label>
                            </div>
                            <li>
                              Do you get at least thirty minutes of exercise or activity each day?

                            </li>
                            <div>
                              <input type="checkbox" id="2" name="radio-button" value="css" checked />
                              <label>
                                <b>Yes</b>
                             </label>
                            </div>
                            <li>
                              Do you get at least thirty minutes of exercise or activity each day?

                            </li>
                            <div>
                              <input type="checkbox" name="radio-button" value="css" checked />
                              <label>
                                <b>Yes</b>
                             </label>
                            </div>
                            <li>
                              Do you get at least thirty minutes of exercise or activity each day?

                            </li>
                            <div>
                              <input type="checkbox" name="radio-button" value="css" checked />
                              <label>
                                <b>Yes</b>
                             </label>
                            </div>
                          </ol>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection