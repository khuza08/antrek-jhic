<footer class="p-4 text-center border-t border-gray-200 dark:border-gray-800">
    <p class="text-sm text-gray-500 dark:text-gray-400">
        © {{ date('Y') }} AntrekAdmin. All rights reserved.
    </p>
</footer>


<script>
    /* fetch data kategori di table kategori dashboard */
    document.addEventListener('DOMContentLoaded', () => {
        fetch('/api/categories')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('categoryTableBody');
                tbody.innerHTML = '';

                const categories = data.categories ?? data;

                if (!Array.isArray(categories) || categories.length === 0) {
                    tbody.innerHTML =
                        `<tr><td colspan="6" class="text-center py-4">Belum ada kategori.</td></tr>`;
                    return;
                }

                categories.forEach((category, index) => {
                    tbody.innerHTML += `
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="py-2 px-3">${index + 1}</td>
                    <td class="py-2 px-3">${category.name}</td>
                    <td class="py-2 px-3">${category.slug}</td>
                    <td class="py-2 px-3">${category.description ?? ''}</td>
                    <td class="py-2 px-3">
                        <button class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500">Edit</button>
                        <button class="bg-red-600 px-3 py-1 rounded hover:bg-red-500">Hapus</button>
                    </td>
                </tr>`;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('categoryTableBody').innerHTML =
                    `<tr><td colspan="6" class="text-center py-4 text-red-400">Gagal memuat data kategori.</td></tr>`;
            });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script defer src="{{ asset('tailadmin/build/bundle.js') }}"></script>
