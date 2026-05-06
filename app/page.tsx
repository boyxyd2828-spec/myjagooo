export default function Home() {
  return (
    <main
      style={{
        minHeight: "100vh",
        background: "linear-gradient(135deg, #0f172a, #1e293b)",
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        fontFamily: "Arial",
      }}
    >
      <div
        style={{
          width: "380px",
          background: "#111827",
          padding: "40px",
          borderRadius: "20px",
          boxShadow: "0 0 30px rgba(0,0,0,0.4)",
          color: "white",
        }}
      >
        <h1
          style={{
            textAlign: "center",
            fontSize: "36px",
            marginBottom: "10px",
          }}
        >
          MyJago 🚀
        </h1>

        <p
          style={{
            textAlign: "center",
            color: "#9ca3af",
            marginBottom: "30px",
          }}
        >
          Secure Digital Banking Login
        </p>

        <div style={{ marginBottom: "20px" }}>
          <label>Email</label>

          <input
            type="email"
            placeholder="you@example.com"
            style={{
              width: "100%",
              padding: "14px",
              marginTop: "8px",
              borderRadius: "12px",
              border: "1px solid #374151",
              background: "#1f2937",
              color: "white",
              outline: "none",
            }}
          />
        </div>

        <div style={{ marginBottom: "25px" }}>
          <label>Password</label>

          <input
            type="password"
            placeholder="••••••••"
            style={{
              width: "100%",
              padding: "14px",
              marginTop: "8px",
              borderRadius: "12px",
              border: "1px solid #374151",
              background: "#1f2937",
              color: "white",
              outline: "none",
            }}
          />
        </div>

        <button
          style={{
            width: "100%",
            padding: "14px",
            background: "#2563eb",
            border: "none",
            borderRadius: "12px",
            color: "white",
            fontSize: "16px",
            cursor: "pointer",
            fontWeight: "bold",
          }}
        >
          Login
        </button>

        <p
          style={{
            textAlign: "center",
            marginTop: "20px",
            color: "#9ca3af",
            fontSize: "14px",
          }}
        >
          Protected by MyJago Security 🔐
        </p>
      </div>
    </main>
  )
}
