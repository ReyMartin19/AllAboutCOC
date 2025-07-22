<div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-8">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold">Members</h2>
        <div class="flex space-x-2">
            <select id="sortField" class="bg-gray-700 text-white rounded px-3 py-1">
                <option value="">Default Order</option>
                <option value="name">Name</option>
                <option value="expLevel">XP</option>
                <option value="townHallLevel">TH</option>
                <option value="role">Role</option>
                <option value="trophies">Trophies</option>
                <option value="donationsReceived">Donation Received</option>
                <option value="donations">Donations</option>
            </select>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-700 border-b border-gray-600">
                <tr>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300">Name</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">XP</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">TH</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">Role</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">Trophies</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">Donation Received</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">Donations</th>
                </tr>
            </thead>
            <tbody id="membersTableBody">
                @foreach($clan['memberList'] as $member)
                    <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                        <td class="px-4 py-4">
                            <div>
                                <div class="font-semibold text-white">
                                    <a href="/player/{{ str_replace('#', '', $member['tag']) }}" class="text-blue-400 hover:underline">{{ $member['name'] }}</a>
                                </div>
                                <div class="text-sm text-gray-400">{{ $member['tag'] }}</div>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-center">{{ $member['expLevel'] }}</td>
                        <td class="px-4 py-4 text-center">{{ $member['townHallLevel'] }}</td>
                        <td class="px-4 py-4 text-center">{{ ucfirst($member['role']) }}</td>
                        <td class="px-4 py-4 text-center">{{ number_format($member['trophies']) }}</td>
                        <td class="px-4 py-4 text-center">{{ $member['donationsReceived'] }}</td>
                        <td class="px-4 py-4 text-green-400 font-semibold text-center">{{ $member['donations'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const members = @json($clan['memberList']);
    const tableBody = document.getElementById('membersTableBody');
    const sortField = document.getElementById('sortField');

    function renderTable(sortedMembers) {
        tableBody.innerHTML = '';
        sortedMembers.forEach(member => {
            const row = document.createElement('tr');
            row.className = 'border-b border-gray-700 hover:bg-gray-700 transition-colors';
            
            row.innerHTML = `
                <td class="px-4 py-4">
                    <div>
                        <div class="font-semibold text-white">
                            <a href="/player/${member.tag.replace('#', '')}" class="text-blue-400 hover:underline">${member.name}</a>
                        </div>
                        <div class="text-sm text-gray-400">${member.tag}</div>
                    </div>
                </td>
                <td class="px-4 py-4 text-center">${member.expLevel}</td>
                <td class="px-4 py-4 text-center">${member.townHallLevel}</td>
                <td class="px-4 py-4 text-center">${member.role.charAt(0).toUpperCase() + member.role.slice(1)}</td>
                <td class="px-4 py-4 text-center">${member.trophies.toLocaleString()}</td>
                <td class="px-4 py-4 text-center">${member.donationsReceived}</td>
                <td class="px-4 py-4 text-green-400 font-semibold text-center">${member.donations}</td>
            `;
            
            tableBody.appendChild(row);
        });
    }

    function sortMembers() {
        const field = sortField.value;
        
        if (!field) {
            // Return to original order if no field is selected
            renderTable(members);
            return;
        }

        const sorted = [...members].sort((a, b) => {
            let valA = a[field];
            let valB = b[field];

            if (typeof valA === 'string') {
                valA = valA.toLowerCase();
                valB = valB.toLowerCase();
            }

            // Always sort in descending order
            if (valA < valB) return 1;
            if (valA > valB) return -1;
            return 0;
        });
        
        renderTable(sorted);
    }

    sortField.addEventListener('change', sortMembers);

    // Initial render
    renderTable(members);
});
</script>