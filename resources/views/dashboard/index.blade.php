<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

<div class="card bg-white shadow rounded-lg p-6 mb-4">
    <div class="flex justify-between items-center border-b pb-4 mb-4">
        <h2 class="text-xl font-semibold">Halaman Dashboard</h2>
    </div>
    <!-- Isi konten card -->
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
  @foreach ($syncLogs as $log)
  <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 
      @if($log->status === 'success') border-green-500 @else border-red-500 @endif">
      
      <div class="flex justify-between items-center">
          <div class="flex items-center">
              @php
                  $icons = [
                      'sheetnames' => '📄',
                      'questionmedias' => '❓',
                      'filemedias' => '🎵',
                  ];
                  $routes = [
                      'sheetnames' => 'sheetname.synchroAll',
                      'questionmedias' => 'media.synchroQuest',
                      'filemedias' => 'media.synchroFile',
                  ];
              @endphp
              <span class="mr-2 text-lg">{{ $icons[$log->process_name] ?? '🔄' }}</span>
              <h3 class="text-lg font-bold text-primary ">{{ $log->process_name }}</h3>
          </div>

          <span class="text-xs  hover:bg-gray-500  hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default
              @if($log->status === 'success') bg-green-100 text-green-700 @else bg-red-100 text-red-700 @endif">
              {{ ucfirst($log->status) }}
          </span>
      </div>
      
      <p class="text-gray-600 text-sm mt-2">
          Terakhir sinkronisasi: <span class="font-medium">{{ $log->updated_at->diffForHumans() }}</span>
      </p>
      <p class="text-gray-500 text-sm">Total perubahan: <span class="font-semibold">{{ $log->changes_count }}</span></p>

      <div class="mt-4 flex items-center justify-between">
          <!-- start::Buttons With Icons Ping -->
          <button
          @click="window.dispatchEvent(new CustomEvent('open-confirm-modal', { 
            detail: { 
                title: 'Sinkronisasi {{ $log->process_name }}!', 
                message: 'Apakah Anda yakin melanjutkan proses sinkronisasi?', 
                url: '{{ route($routes[$log->process_name]) }}', 
                method: 'GET', 
                buttonText: 'Sync' 
            }
        }))"
           class="relative flex items-center justify-center border border-purple-500 text-purple-500 rounded-sm px-4 py-1.5 hover:shadow-xl transition duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M4 10l6-6m10 10l-6 6"></path></svg>
            <span class="text-sm">Synchronize</span>
            <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span>
            </span>
        </button>
          
          @if($log->status === 'failed')
          <span class="text-sm text-red-600">Terjadi kesalahan, cek log!</span>
          @endif
      </div>
  </div>
  @endforeach
</div>

<div class="mt-6">
  <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Sinkronisasi</h3>
      <table class="w-full text-sm text-left border-collapse">
          <thead class="text-gray-600 bg-gray-100">
              <tr>
                  <th class="p-2 border">#</th>
                  <th class="p-2 border">Proses</th>
                  <th class="p-2 border">Status</th>
                  <th class="p-2 border">Waktu</th>
                  <th class="p-2 border">Keterangan</th>
              </tr>
          </thead>
          <tbody>
              @forelse ($logs->sortByDesc('updated_at')->take(10) as $log)
              
              <tr class="border-b">
                  <td class="p-2">{{ $loop->iteration }}</td>
                  <td class="p-2"><a href="{{ route('dashboard.detail', $log->id) }}">{{ $log->process_name }}</a></td>
                  <td class="p-2">
                      <span class="px-2 py-1 rounded text-xs
                          @if($log->status === 'success') bg-green-100 text-green-700 
                          @else bg-red-100 text-red-700 @endif">
                          {{ ucfirst($log->status) }}
                      </span>
                  </td>
                  <td class="p-2">{{ $log->updated_at->diffForHumans() }}</td>
                  <td class="p-2 truncate max-w-[300px]">{{ $log->message }}</td>
              </tr>
              @empty
            <tr class="border-b">
              <td class="p-3">Data not found.</td>
            </tr>
              @endforelse
          </tbody>
      </table>
  </div>
</div>


<x-route-confirm></x-route-confirm>

<script>
function syncNow(processName) {
  fetch(`/sync/${processName}`, { method: 'POST' })
      .then(response => response.json())
      .then(data => alert(data.message))
      .catch(error => alert('Sinkronisasi gagal!'));
}
</script>



</x-layout>