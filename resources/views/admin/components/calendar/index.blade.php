 @extends('admin.template-parts.master')
 @section('content')
    <div class="content-wrapper">
        <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Calendar</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Calendar</li>
                </ol>
            </div>
            </div>
        </div>
        <!-- main body -->
        <div class="calendar-main mb-30">
        <div class="row">
        <div class="col-lg-3">
            <div class="row">
                <div class="col-12 sm-mb-30">
                    <a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-primary btn-block ripple m-t-20">
                            <i class="fa fa-plus pr-2"></i> Create New
                        </a>
                    <div id="external-events" class="m-t-20">
                        <br>
                        <p class="text-muted">Drag and drop your event or click in the calendar</p>
                        <div class="external-event bg-success fc-event ui-draggable ui-draggable-handle" data-class="bg-success">
                            <i class="fa fa-circle mr-2 vertical-middle"></i>New Theme Release
                        </div>
                        <div class="external-event bg-info fc-event ui-draggable ui-draggable-handle" data-class="bg-info">
                            <i class="fa fa-circle mr-2 vertical-middle"></i>My Event
                        </div>
                        <div class="external-event bg-warning fc-event ui-draggable ui-draggable-handle" data-class="bg-warning">
                            <i class="fa fa-circle mr-2 vertical-middle"></i>Meet manager
                        </div>
                        <div class="external-event bg-danger fc-event ui-draggable ui-draggable-handle" data-class="bg-danger">
                            <i class="fa fa-circle mr-2 vertical-middle"></i>Create New theme
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div id="calendar" class="fc fc-unthemed fc-ltr"><div class="fc-toolbar fc-header-toolbar"><div class="fc-left"><div class="fc-button-group"><button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left" aria-label="prev"><span class="fc-icon fc-icon-left-single-arrow"></span></button><button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right" aria-label="next"><span class="fc-icon fc-icon-right-single-arrow"></span></button></div><button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right fc-state-disabled" disabled="">today</button></div><div class="fc-right"><div class="fc-button-group"><button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">month</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default">week</button><button type="button" class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">day</button></div></div><div class="fc-center"><h4>September 2019</h4></div><div class="fc-clear"></div></div><div class="fc-view-container" style=""><div class="fc-view fc-month-view fc-basic-view" style=""><table class=""><thead class="fc-head"><tr><td class="fc-head-container fc-widget-header"><div class="fc-row fc-widget-header"><table class=""><thead><tr><th class="fc-day-header fc-widget-header fc-sun"><span>Sun</span></th><th class="fc-day-header fc-widget-header fc-mon"><span>Mon</span></th><th class="fc-day-header fc-widget-header fc-tue"><span>Tue</span></th><th class="fc-day-header fc-widget-header fc-wed"><span>Wed</span></th><th class="fc-day-header fc-widget-header fc-thu"><span>Thu</span></th><th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th><th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th></tr></thead></table></div></td></tr></thead><tbody class="fc-body"><tr><td class="fc-widget-content"><div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 541px;"><div class="fc-day-grid fc-unselectable"><div class="fc-row fc-week fc-widget-content" style="height: 90px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-09-01"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-09-02"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-09-03"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-09-04"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-09-05"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-09-06"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-09-07"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-09-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-09-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-09-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-09-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-09-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-09-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-09-07"><span class="fc-day-number">7</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 90px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-09-08"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-09-09"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-09-10"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-09-11"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-09-12"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-09-13"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-09-14"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-09-08"><span class="fc-day-number">8</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-09-09"><span class="fc-day-number">9</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-09-10"><span class="fc-day-number">10</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-09-11"><span class="fc-day-number">11</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-09-12"><span class="fc-day-number">12</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-09-13"><span class="fc-day-number">13</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-09-14"><span class="fc-day-number">14</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 89px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-09-15"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-09-16"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-09-17"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-09-18"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-09-19"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-09-20"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-09-21"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-09-15"><span class="fc-day-number">15</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-09-16"><span class="fc-day-number">16</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-09-17"><span class="fc-day-number">17</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-09-18"><span class="fc-day-number">18</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-09-19"><span class="fc-day-number">19</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-09-20"><span class="fc-day-number">20</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-09-21"><span class="fc-day-number">21</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 90px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-09-22"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-09-23"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-09-24"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-09-25"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-09-26"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-09-27"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-09-28"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-09-22"><span class="fc-day-number">22</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-09-23"><span class="fc-day-number">23</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-09-24"><span class="fc-day-number">24</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-09-25"><span class="fc-day-number">25</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-09-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-09-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-09-28"><span class="fc-day-number">28</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 90px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-09-29"></td><td class="fc-day fc-widget-content fc-mon fc-today " data-date="2019-09-30"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2019-10-01"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2019-10-02"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2019-10-03"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2019-10-04"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2019-10-05"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-09-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-mon fc-today " data-date="2019-09-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2019-10-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2019-10-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2019-10-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2019-10-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2019-10-05"><span class="fc-day-number">5</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 91px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-future" data-date="2019-10-06"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2019-10-07"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2019-10-08"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2019-10-09"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2019-10-10"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2019-10-11"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2019-10-12"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-future" data-date="2019-10-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-mon fc-other-month fc-future" data-date="2019-10-07"><span class="fc-day-number">7</span></td><td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2019-10-08"><span class="fc-day-number">8</span></td><td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2019-10-09"><span class="fc-day-number">9</span></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2019-10-10"><span class="fc-day-number">10</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2019-10-11"><span class="fc-day-number">11</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2019-10-12"><span class="fc-day-number">12</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table></div></div></div>


            <div id="calendar-container">
                <div id="calendar"></div>
            </div>
            <div class="modal" tabindex="-1" role="dialog" id="event-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Event</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body p-20"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default ripple" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success save-event ripple">Create event</button>
                            <button type="button" class="btn btn-danger delete-event ripple" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Add Category -->
            <div class="modal" tabindex="-1" role="dialog" id="add-category">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add a category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body p-20">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Category Name</label>
                                        <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Choose Category Color</label>
                                        <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                            <option value="success">Success</option>
                                            <option value="danger">Danger</option>
                                            <option value="info">Info</option>
                                            <option value="primary">Primary</option>
                                            <option value="warning">Warning</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success ripple save-category" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
 <!--=================================
 wrapper -->

<!--=================================
 footer -->

    <footer class="bg-white p-4">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center text-md-left">
              <p class="mb-0"> © Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>2019</span>. <a href="#"> Webmin </a> All Rights Reserved. </p>
          </div>
        </div>
        <div class="col-md-6">
          <ul class="text-center text-md-right">
            <li class="list-inline-item"><a href="#">Terms &amp; Conditions </a> </li>
            <li class="list-inline-item"><a href="#">API Use Policy </a> </li>
            <li class="list-inline-item"><a href="#">Privacy Policy </a> </li>
          </ul>
        </div>
      </div>
    </footer>
    </div>

 @endsection
