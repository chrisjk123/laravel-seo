@php $meta = seo()->toArray(); @endphp

@foreach ($meta as $item)
{!! $item->toHtml() !!}
@endforeach

{{-- TODO: include favicon package data --}}