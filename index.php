<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safepay Integration</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f5f5f5; }
        .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        button { background: #4caf50; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Safepay Payment</h2>
        <form id="paymentForm" method="POST" action="payment.php">
            <button type="submit">Pay Now</button>
        </form>
        <div id="paymentLink" style="margin-top: 20px;"></div>
    </div>
    <script>
        const form = document.getElementById('paymentForm');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const response = await fetch('payment.php', { method: 'POST' });
            const data = await response.json();
            document.getElementById('paymentLink').innerHTML = `
                <a href="${data.data.redirect_url}" target="_blank">Complete Payment</a>
            `;
        });
    </script>
</body>
</html>
