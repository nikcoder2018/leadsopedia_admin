<!-- Detailed Email Header starts -->
<div class="email-detail-header">
    <div class="email-header-left d-flex align-items-center">
        <span class="go-back mr-1"><i data-feather="chevron-left" class="font-medium-4"></i></span>
        <h4 class="email-subject mb-0">{{$subject}}</h4>
    </div>
    <div class="email-header-right ml-2 pl-1">
        <ul class="list-inline m-0">
            <li class="list-inline-item email-del" data-id="{{$id}}">
                <span class="action-icon"><i data-feather="trash" class="font-medium-2"></i></span>
            </li>
            <li class="list-inline-item email-prev" data-id="{{$id}}">
                <span class="action-icon"><i data-feather="chevron-left" class="font-medium-2"></i></span>
            </li>
            <li class="list-inline-item email-next" data-id="{{$id}}">
                <span class="action-icon"><i data-feather="chevron-right" class="font-medium-2"></i></span>
            </li>
        </ul>
    </div>
</div>
<!-- Detailed Email Header ends -->

<!-- Detailed Email Content starts -->
<div class="email-scroll-area">
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header email-detail-head">
                    <div class="user-details d-flex justify-content-between align-items-center flex-wrap">
                        <div class="avatar mr-75">
                            <img src="{{ asset(env('APP_THEME', 'default') . '/app-assets/images/avatars/noface.png')}}" alt="avatar img holder" width="48" height="48" />
                        </div>
                        <div class="mail-items">
                            <h5 class="mb-0">{{$name}}</h5>
                            <div class="email-info-dropup dropdown">
                                <span role="button" class="dropdown-toggle font-small-3 text-muted" id="card_top01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$email}}
                                </span>
                                <div class="dropdown-menu" aria-labelledby="card_top01">
                                    <table class="table table-sm table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">From:</td>
                                                <td>{{$email}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Date:</td>
                                                <td>{{Carbon\Carbon::parse($created_at)->format('d M Y, H:i')}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mail-meta-item d-flex align-items-center">
                        <small class="mail-date-time text-muted">{{Carbon\Carbon::parse($created_at)->format('d M Y, H:i')}}</small>
                    </div>
                </div>
                <div class="card-body mail-message-wrapper pt-2">
                    <div class="mail-message">
                        <p class="card-text">
                            {{$message}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-0">
                            Click here to
                            <a href="javascript:void(0);" class="reply-message" data-email="{{$email}}">Reply</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Detailed Email Content ends -->