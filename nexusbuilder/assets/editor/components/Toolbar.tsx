import React from 'react';
import { useBuilderStore } from '../store/useBuilderStore';

export const Toolbar = () => {
  const undo = useBuilderStore((s) => s.undo);
  const redo = useBuilderStore((s) => s.redo);
  const setDevice = useBuilderStore((s) => s.setDevice);

  return (
    <div className="nb-toolbar">
      <button onClick={undo}>Undo</button>
      <button onClick={redo}>Redo</button>
      <button onClick={() => setDevice('desktop')}>Desktop</button>
      <button onClick={() => setDevice('tablet')}>Tablet</button>
      <button onClick={() => setDevice('mobile')}>Mobile</button>
      <button>AI Assistant</button>
      <button>Save</button>
    </div>
  );
};
