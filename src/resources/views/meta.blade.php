@php $meta = seo()->toArray(); @endphp

@foreach ($meta as $item)
{!! $item->toHtml() !!}
@endforeach