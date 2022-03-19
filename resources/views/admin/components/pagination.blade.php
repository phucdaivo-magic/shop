
<div
    cs-num="5"
    cs-record="{{ $data['tableData']->perPage() }}"
    cs-cur="{{ $data['tableData']->currentPage() }}"
    cs-total="{{ $data['tableData']->total() }}"
    cs-request="{{ $data['tableData']->getOptions()['path'] }}"
    cs-query="{{ $data['query'] ?? '' }}"
    init-controll="pagination"
    >
</div>
