<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">{{$title}}</h2>
        <div class="breadcrumb-wrapper">
            <?php $segments = ''; ?>
            <ol class="breadcrumb">
            @foreach(Request::segments() as $segment)
                <?php $segments .= '/'.$segment; ?>
                <li class="breadcrumb-item @if($loop->last) active @endif">
                    @if(!$loop->last)  
                        <a href="{{ $segments }}">{{ucfirst($segment)}}</a>
                    @else 
                        {{ucfirst($segment)}}
                    @endif
                </li>
            @endforeach
            </ol>
        </div>
    </div>
</div>
