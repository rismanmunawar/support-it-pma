import * as XLSX from 'xlsx';

document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('excelFile');
    const table = document.getElementById('excelTable');
    const thead = document.getElementById('tableHead');
    const tbody = document.getElementById('tableBody');

    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (evt) => {
            const bstr = evt.target.result;
            const workbook = XLSX.read(bstr, { type: 'binary' });
            const worksheet = workbook.Sheets[workbook.SheetNames[0]];
            const raw = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

            const header = raw[0];
            const firstDateColIndex = 2;
            const lastDateColIndex = header.length - 1;
            const dayCount = lastDateColIndex - firstDateColIndex + 1;

            // Buat header tabel
            let headHtml = `<tr>
                <th class="border p-2">Plant</th>
                <th class="border p-2">Plant Name</th>`;
            for (let i = 0; i < dayCount; i++) {
                headHtml += `<th class="border p-1 text-center">${String(i + 1).padStart(2, '0')}</th>`;
            }
            headHtml += `<th class="border p-2 text-red-600">Jml ❌</th></tr>`;
            thead.innerHTML = headHtml;

            // Proses data
            const rows = raw.slice(1).map((row) => {
                const plant = row[0];
                const name = row[1];
                const statuses = row.slice(firstDateColIndex, lastDateColIndex + 1).map((cell) => {
                    if (cell === '@0V@') return '✅';
                    if (cell === '@30@') return '❌';
                    if (cell === '@3O@') return '🛌';
                    if (cell === '@02@') return '⚠️';
                    return '';
                });
                const jml_x = statuses.filter((s) => s === '❌' || s === '⚠️').length;
                return { plant, name, statuses, jml_x };
            }).filter(row => row.statuses.some(s => s === '❌' || s === '⚠️'));

            // Buat body tabel
            let bodyHtml = '';
            rows.forEach((row) => {
                bodyHtml += `<tr>
                    <td class="border p-1">${row.plant}</td>
                    <td class="border p-1">${row.name}</td>`;
                row.statuses.forEach(status => {
                    bodyHtml += `<td class="border text-center">${status}</td>`;
                });
                bodyHtml += `<td class="border text-center text-red-600 font-bold">${row.jml_x}</td></tr>`;
            });

            tbody.innerHTML = bodyHtml;
            table.classList.remove('hidden');
        };
        reader.readAsBinaryString(file);
    });
});
