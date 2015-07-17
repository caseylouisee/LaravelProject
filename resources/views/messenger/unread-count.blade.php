<?php $count = Auth::user()->newMessagesCount(); ?>
@if($count > 0)
<span class="badge alert-danger">{!! $count !!}</span>
@endif
