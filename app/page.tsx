export default function Home() {
  return (
    <main
      style={{
        minHeight: "100vh",
        background: "linear-gradient(to bottom, #0f172a, #1e293b)",
        color: "white",
        fontFamily: "Arial",
        padding: "40px"
      }}
    >
      <nav
        style={{
          display: "flex",
          justifyContent: "space-between",
          alignItems: "center",
          marginBottom: "80px"
        }}
      >
        <h1 style={{ fontSize: "32px" }}>MyJago 🚀</h1>

        <div style={{ display: "flex", gap: "20px" }}>
          <a href="#">Home</a>
          <a href="#">Features</a>
          <a href="#">About</a>
        </div>
      </nav>

      <section
        style={{
          textAlign: "center",
          marginTop: "100px"
        }}
      >
        <h2
          style={{
            fontSize: "64px",
            marginBottom: "20px"
          }}
        >
          Digital Banking Future
        </h2>

        <p
          style={{
            fontSize: "22px",
            color: "#cbd5e1",
            maxWidth: "700px",
            margin: "0 auto"
          }}
        >
          Kelola keuangan modern dengan pengalaman cepat,
          aman, dan elegan.
        </p>

        <button
          style={{
            marginTop: "40px",
            padding: "16px 32px",
            borderRadius: "14px",
            border: "none",
            background: "#3b82f6",
            color: "white",
            fontSize: "18px",
            cursor: "pointer"
          }}
        >
          Mulai Sekarang
        </button>
      </section>
    </main>
  )
}
