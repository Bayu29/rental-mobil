<td>
    @can('transaction_update')
    <a href="{{ route('transaction.edit', $model->id) }}" class="btn btn-sm  btn-warning"><i class="mdi mdi-pencil"></i>  </a>
    @endcan
</td>
