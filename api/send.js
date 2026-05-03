export default async function handler(req, res) {
  if (req.method !== "POST") {
    return res.status(405).json({ error: "Method not allowed" });
  }

  const { name, phone, message } = req.body;

  const text =
`📩 Form Baru
Nama: ${name}
No HP: ${phone}
Pesan: ${message}`;

  const url = `https://api.telegram.org/bot${process.env.TELEGRAM_BOT_TOKEN}/sendMessage`;

  const response = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      chat_id: "6959842489",
      text
    })
  });

  const result = await response.json();
  return res.status(200).json(result);
}
