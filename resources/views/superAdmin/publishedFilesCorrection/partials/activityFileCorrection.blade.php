<table>
    <thead>
    <tr>
        <th>S. N.</th>
        <th>Activity File</th>
        <th>Activities Included</th>
        <th>Actions</th>
    </tr>
    </thead>
    <div class="pull-right">
        <strong>
            <a href="{{ route('superadmin.reSync', $organization->id) }}">Sync</a>
        </strong>
    </div>
    <tbody>
    @forelse ($publishedFiles as $index => $publishedFile)
        <tr>
            <td>
                {{ $index + 1 }}
            </td>
            <td>
                @if ($publishedFile->published_activities)
                    @foreach ($publishedFile->published_activities as $publishedActivity)
                        <a href="{{ url('/files/xml/') . '/' . $publishedActivity }}">{{ $publishedActivity }}, </a>
                    @endforeach
                @else
                    None
                @endif
            </td>
            <td>
                @if (file_exists(public_path('/files/xml/') . '/' . $publishedFile->filename))
                    <a href="{{ url('/files/xml/') . '/' . $publishedFile->filename }}">{{ $publishedFile->filename }}</a>
                @else
                    {{ $publishedFile->filename }}
                @endif
            </td>
            <td>
                @if (!$publishedFile->published_to_register)
                    {!! Form::open(['method' =>'DELETE', 'url' => route('superadmin.deleteXmlFile', ['organizationId' => $organization->id, 'fileId' => $publishedFile->id])]) !!}
                    {!! Form::submit('Delete') !!}
                    {!! Form::close() !!}
                @else
                    <a href="{{ route('superadmin.unlinkXmlFile', [$organization->id, $publishedFile->id]) }}">Unlink</a>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">
                <b>No Files Found.</b>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
