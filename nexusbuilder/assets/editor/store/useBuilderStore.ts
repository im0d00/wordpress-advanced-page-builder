import { create } from 'zustand';

type Device = 'desktop' | 'tablet' | 'mobile';

type ElementNode = {
  id: string;
  type: string;
  settings: Record<string, unknown>;
  children: ElementNode[];
};

type State = {
  tree: ElementNode[];
  past: ElementNode[][];
  future: ElementNode[][];
  device: Device;
  setTree: (tree: ElementNode[]) => void;
  undo: () => void;
  redo: () => void;
  setDevice: (device: Device) => void;
};

export const useBuilderStore = create<State>((set) => ({
  tree: [],
  past: [],
  future: [],
  device: 'desktop',
  setTree: (tree) =>
    set((state) => ({ tree, past: [...state.past, state.tree], future: [] })),
  undo: () =>
    set((state) => {
      if (!state.past.length) return state;
      const prev = state.past[state.past.length - 1];
      return {
        tree: prev,
        past: state.past.slice(0, -1),
        future: [state.tree, ...state.future],
      };
    }),
  redo: () =>
    set((state) => {
      if (!state.future.length) return state;
      const next = state.future[0];
      return {
        tree: next,
        past: [...state.past, state.tree],
        future: state.future.slice(1),
      };
    }),
  setDevice: (device) => set({ device }),
}));
