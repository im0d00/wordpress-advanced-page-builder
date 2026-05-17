import React from 'react';
import { createRoot } from 'react-dom/client';
import { useBuilderStore } from './store/useBuilderStore';
import { LeftPanel } from './components/LeftPanel';
import { Canvas } from './components/Canvas';
import { RightPanel } from './components/RightPanel';
import { Toolbar } from './components/Toolbar';
import { AIAssistant } from './components/AIAssistant';

const App = () => {
  const device = useBuilderStore((s) => s.device);

  return (
    <div className={`nb-editor nb-device-${device}`}>
      <Toolbar />
      <div className="nb-layout">
        <LeftPanel />
        <Canvas />
        <RightPanel />
      </div>
      <AIAssistant />
    </div>
  );
};

const target = document.getElementById('nexusbuilder-editor-root');
if (target) {
  createRoot(target).render(<App />);
}
