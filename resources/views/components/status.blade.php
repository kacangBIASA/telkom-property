@props(['s'])
@php $c = ['terpakai' => 'bg-green-50 text-green-700 ring-green-200', 'sebagian' => 'bg-amber-50 text-amber-700 ring-amber-200', 'kosong' => 'bg-red-50 text-red-700 ring-red-200'][$s]; @endphp
<span class="badge ring-1 ring-inset {{ $c }}">{{ ucfirst($s) }}</span>
