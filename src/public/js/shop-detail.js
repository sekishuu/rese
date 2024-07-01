document.addEventListener('DOMContentLoaded', function () {
    // 通常の予約フォーム
    document.getElementById('reserve_date').addEventListener('change', function () {
        document.getElementById('selected_date').innerText = this.value;
    });

    document.getElementById('reserve_time').addEventListener('change', function () {
        document.getElementById('selected_time').innerText = this.value;
    });

    document.getElementById('number_of_people').addEventListener('change', function () {
        document.getElementById('selected_people').innerText = this.value;
    });

    // モーダル内の予約フォーム
    document.getElementById('modal_reserve_date').addEventListener('change', function () {
        document.getElementById('selected_date_modal').innerText = this.value;
    });

    document.getElementById('modal_reserve_time').addEventListener('change', function () {
        document.getElementById('selected_time_modal').innerText = this.value;
    });

    document.getElementById('modal_number_of_people').addEventListener('change', function () {
        document.getElementById('selected_people_modal').innerText = this.value;
    });
});
