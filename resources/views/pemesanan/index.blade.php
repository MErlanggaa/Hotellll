@extends('layouts.admin', ['title' => 'Pemesanan'])


@section('content')
<x-status />
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <x-search />
            </div>
        </div>
    </div>
    <x-card-table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Tanggal Check-in</th>
                <th>Tanggal Check-out</th>
                <th>Jenis Kamar</th>
                <th>Aksi</th>
            </tr>
        </thead>


        <?php $no = $data->firstItem(); ?>
        @if($data->isEmpty())
        <tr>
            <td colspan="6" class="text-center">Nama Tamu yang dicari tidak ada.</td>
        </tr>
        @endif

        @foreach ($data as $row)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->checkin }}</td>
            <td>{{ $row->checkout }}</td>
            <td>{{ $row->jenis }}</td>

            <td>
                <x-btn-delete :link="route('pemesanan.destroy', ['pemesanan' => $row->id])" />
            </td>

        </tr>
        @endforeach
        </tbody>
        </table>
    </x-card-table>
</div>
<div class="card-body pb-0">
    {{ $data->appends(['search' => request()->search])->links('page') }}
</div>
</div>
@endsection

@section('modal')
<x-modal-delete />
@endsection