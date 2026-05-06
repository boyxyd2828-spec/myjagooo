export const metadata = {
  title: "MyJago Kredit",
  description: "Premium Kredit Digital",
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="id">
      <body>{children}</body>
    </html>
  );
}
