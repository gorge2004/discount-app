@extends('index')
@section('title', 'Discounts')
@section('content')
    <div class="row">
        <div class="col-12 col-lg-4">
            <h2>Discounts</h2>
        </div>
		<div class="col-12 col-6">
			<a class="btn btn-success" href="{{ route('discount.create') }}">Crear</a>

		</div>
    </div>
    <div class="row table-responsive">

        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Start at</th>
                    <th>End at</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th></th>
                </tr>

            </thead>
            <tbody>
                @foreach ($discounts as $discount)
                    <tr>
                        <td>{{ $discount->title }}</td>
                        <td>{{ $discount->code }}</td>
                        <td>{{ $discount->description }}</td>
                        <td>{{ $discount->start_at }}</td>
                        <td>{{ $discount->end_at }}</td>
                        <td>
                            @if ($discount->main_image)
                                <img widht="50" height="50" src="{{ asset('storage/discount/' . $discount->main_image) }}"
                                    alt="{{ $discount->main_image }}">
                            @else
                                {{ '-' }}
                            @endif
                        </td>
                        <td>

                            @php
                                $typeClassCss = 'warning';
                                if ($discount->type == 'coupon') {
                                    $typeClassCss = 'primary';
                                }
                            @endphp
                            <span class="badge bg-{{ $typeClassCss }}">{{ $discount->type }}</span>
                        </td>
                        <td>
                            @php
                                $statusClassCss = 'danger';
                                if ($discount->status == 'active') {
                                    $statusClassCss = 'primary';
                                } elseif ($discount->status = 'schedule') {
                                    $statusClassCss = 'warning';
                                }

                            @endphp
                            <span class="badge bg-{{ $statusClassCss }}"> {{ $discount->status }}</span>

                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('discount.edit', $discount->id) }}">Edit</a>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    </div>
@endsection
@section('scriptJs')
    <script type="text/javascript">
        $(document).ready(function() {
            const url = "{{ route('discount.api.index') }}";
            const url_edit = "{{ route('discount.index', '') }}";
            let offset = 0;
            let lenght = 10;
            var table = $('#table');
            const url_asset = "{{ asset('storage/discount/') }}";

            table.DataTable();

            table.on('length.dt', async function(e, settings, len) {
                console.log('New page length: ' + len, url);
                lenght = len;
                table.DataTable()
                    .clear()
                    .draw();
                const response = await fetch(`${url}?length=${lenght}`);
                const data = await response.json();
                for (const discount of data) {
                    let statusClassCss = 'danger';
                    if (discount.status == 'active') {
                        statusClassCss = 'primary';
                    } else if (discount.status = 'schedule') {
                        statusClassCss = 'warning';

                    }

                    const bagdeStatus =
                        `<span class = "badge bg-${ statusClassCss }" > ${ discount.status } </span>`;
                    let typeClassCss = 'warning';
                    if (discount.type == 'coupon') {
                        typeClassCss = 'primary';
                    }
                    const bagdeType =
                        `<span class = "badge bg-${ typeClassCss }" > ${ discount.type } </span>`;


                    table.DataTable().row.add([
                        discount.title,
                        discount.code,
                        discount.description,
                        discount.start_at,
                        discount.end_at,
                        discount.main_image ? `<img widht="50" height="50" src="${ url_asset+'/'+ discount.main_image }"
                                    alt="${ discount.main_image }">` : '-',
                        bagdeType,
                        bagdeStatus,
                        `<a href="${url_edit}/edit/${discount.id}" class="btn btn-primary">Edit</a>`,


                    ]).draw(true);

                }


            });



            function editarButton(discount) {
                const a = document.createElement('a');
                a.classList.add('btn', 'btn-primary');
                a.appendChild(document.createTextNode('Edit'));
                a.href = url_edit + discount.id;
                return a;
            }
        });
    </script>
@endsection
