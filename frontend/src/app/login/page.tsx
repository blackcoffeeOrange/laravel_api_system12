'use client';

import { useState } from 'react';
import axios from 'axios';
import { useRouter } from 'next/navigation'; // App Router では `useRouter` は `next/navigation` からインポート

const LoginPage = () => {
  const router = useRouter();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    try {
      const res = await axios.post('http://localhost:8000/api/login', {
        email,
        password,
      });

      const token = res.data.token;

      localStorage.setItem('token', token);

      router.push('/dashboard'); // ログイン成功したらダッシュボードへ
    } catch (err) {
      console.error(err);
      setError('ログインに失敗しました');
    }
  };

  return (
    <div className="container mt-5" style={{ maxWidth: '400px' }}>
      <h1 className="mb-4">ログイン</h1>
      {error && <div className="alert alert-danger">{error}</div>}
      <form onSubmit={handleSubmit}>
        <div className="form-group mb-3">
          <label>メールアドレス</label>
          <input
            type="email"
            className="form-control"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />
        </div>

        <div className="form-group mb-3">
          <label>パスワード</label>
          <input
            type="password"
            className="form-control"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
          />
        </div>

        <button type="submit" className="btn btn-primary w-100">
          ログイン
        </button>
      </form>
    </div>
  );
};

export default LoginPage;
