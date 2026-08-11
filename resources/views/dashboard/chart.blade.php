<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-xl font-bold">
                Statistik Reminder
            </h2>

            <p class="text-gray-500 text-sm">
                Reminder WhatsApp terkirim selama bulan ini
            </p>

        </div>

        <div class="text-right">

            <h2 class="text-3xl font-bold text-blue-600">

                {{ $totalReminder }}

            </h2>

            <p class="text-gray-500 text-sm">

                Reminder Sent

            </p>

        </div>

    </div>

    <canvas id="reminderChart" height="120"></canvas>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('reminderChart');

    if(!ctx) return;

    new Chart(ctx,{

        type:'line',

        data:{

            labels:@json($chartLabels),

            datasets:[{

                label:'Reminder',

                data:@json($chartData),

                borderWidth:3,

                tension:0.4,

                fill:true,

                backgroundColor:'rgba(59,130,246,.12)',

                borderColor:'#2563eb',

                pointRadius:4,

                pointHoverRadius:6

            }]

        },

        options:{

            responsive:true,

            plugins:{

                legend:{

                    display:false

                }

            },

            scales:{

                y:{

                    beginAtZero:true

                }

            }

        }

    });

});

</script>
