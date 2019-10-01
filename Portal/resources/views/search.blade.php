@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('js/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">@lang('messages.Search')</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">@lang('messages.App')</li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('messages.Search')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default d-flex justify-content-between">
                <h3 class="block-title">@lang('messages.Search')</h3>
                <a class="" href="#" data-toggle="modal" data-target="#help-modal">
                    <i class="si si-question"></i></a>
            </div>
            <div class="block-content block-content-full">
                <form action="{{url('/search')}}" method="get">
                    <h2 class="content-heading pt-0">@lang('messages.Search Criteria')</h2>
                    <div class="col-lg-10 col-xl-10 row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input">@lang('messages.Time Range')</label>
                                <div class="input-daterange input-group" data-date-format="yyyy-mm-dd" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                    <input type="text" class="form-control" name="date_from" placeholder="@lang('messages.From')" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_from}}">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text font-w600">
                                            <i class="fa fa-fw fa-arrow-right"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="date_to" placeholder="@lang('messages.To')" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_to}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="d-block">@lang('messages.Message Type')</label>
                                <div class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="checkbox_sent" name="show_sent" @if($show_sent == 'on') checked @endif>
                                    <label class="custom-control-label" for="checkbox_sent">@lang('messages.Sent')</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="checkbox_spam" name="show_spam" @if($show_spam == 'on') checked @endif>
                                    <label class="custom-control-label" for="checkbox_spam">@lang('messages.Spam')</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="checkbox_attachment" name="show_attachment" @if($show_attachment == 'on') checked @endif>
                                    <label class="custom-control-label" for="checkbox_attachment">@lang('messages.Attachment')</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="checkbox_virus" name="show_virus" @if($show_virus == 'on') checked @endif>
                                    <label class="custom-control-label" for="checkbox_virus">@lang('messages.Virus')</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input">@lang('messages.Send From')</label>
                                <input type="text" class="form-control" name="send_from" value="{{$send_from}}">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">@lang('messages.Send To')</label>
                                <input type="text" class="form-control" name="send_to" value="{{$send_to}}">
                            </div>
                        </div>
                        <div class="col-md-3 row">
                            <div style="position: absolute; bottom: 0; margin-bottom: 1rem;">
                                <button type="submit"  class="btn btn-primary">@lang('messages.Search')</button>
                                <a href="{{url('/search')}}" class="btn btn-success">@lang('messages.Clear')</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="block-content block-content-full">
                <h2 class="content-heading pt-0">@lang('messages.Search Result')</h2>
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th class="d-none d-sm-table-cell" style="width: 250px;">@lang('messages.Time')</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">@lang('messages.Message From')</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">@lang('messages.Message To')</th>
                        <th class="d-none d-sm-table-cell" style="width: 250px;">@lang('messages.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($search_result as $one)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="d-none d-sm-table-cell">
                                {{$one->timestamp}}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{$one->msg_from}}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{$one->msg_to}}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                @if($one->action == 'sent')
                                    <span class="badge badge-success">{{$one->action}}</span>
                                @elseif($one->action == 'spam')
                                    <span class="badge badge-info">{{$one->action}}</span>
                                @elseif($one->action == 'attachment')
                                    <span class="badge badge-warning">{{$one->action}}</span>
                                @else
                                    <span class="badge badge-danger">{{$one->action}}</span>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="help-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0" >
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Modal Title</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END Page Content -->
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page JS Code -->
    <script src="{{asset('js/pages/be_tables_datatables.min.js')}}"></script>

    <script>jQuery(function(){ Dashmix.helpers(['datepicker']); });</script>
@endsection